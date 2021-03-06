<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Str;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasDateTimeFormatter;

    const STATUS_NOT_CERTIFIED = 'not_certified';
    const STATUS_AUDITING = 'auditing';
    const STATUS_FAILED = 'failed';
    const STATUS_SUCCESS = 'success';

    const GRADE_ONE = 'one';
    const GRADE_TWO = 'two';
    const GRADE_THREE = 'three';
    const GRADE_FOUR  = 'four';
    const GRADE_FIVE  = 'five';
    const GRADE_SIX  = 'six';
    const GRADE_ZERO = 'zero';

    public static $statusMap = [
            self::STATUS_NOT_CERTIFIED => '未提交资料',
            self::STATUS_AUDITING       => '认证中',
            self::STATUS_FAILED     => '认证失败',
            self::STATUS_SUCCESS        => '认证成功',
        ];
    public static $gradeMap = [
            self::GRADE_ZERO => '新会员',
            self::GRADE_ONE => '普通会员',
            self::GRADE_TWO => '精英会员',
            self::GRADE_THREE => '银牌会员',
            self::GRADE_FOUR => '金牌会员',
            self::GRADE_FIVE => '白金会员',
            self::GRADE_SIX => '钻石会员',
        ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'avatar',
        'email',
        'phone',
        'password',
        'safe_password',
        'idcard_data',
        'status',
        'invite_id',
        'grade',
        'admin_id',
        'openid',
        'created_at',
        'apply_at',
        'share_rate',
    ];

    protected $appends = ['team_count', 'grade_full', 'grade_list', 'by_vip', 'upload_data', 'full_status', 'parent', 'sum_info'];

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建时间，写入数据库之后触发
        static::created(function ($model) {
            // 生成用户钱包
            $service = new \App\Services\WalletService();
            $service->generateWallets($model);
        });
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'safe_password',
    ];

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function miners()
    {
        return $this->hasMany(Miner::class);
    }

    public function recharges()
    {
        return $this->hasMany(Recharge::class);
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function getTeamCountAttribute()
    {
        return $this->where('invite_id', $this->id)->count();
    }


    public function myPowers()
    {
        $powers = 0;
        $orders = Order::where(['user_id' => $this->id,
        'status' => Order::STATUS_SUCCESS,
        'closed' => false,
        ])->with(['product'])->get();
        foreach ($orders as $order) {
            $powers += $order->amount * $order->product->amount;
        }

        return $powers;
    }

    public function getFullStatusAttribute()
    {
        return isset(self::$statusMap[$this->attributes['status']]) ? self::$statusMap[$this->attributes['status']] : '未认证';
    }

    public function getGradeFullAttribute()
    {
        return isset($this->attributes['grade']) && $this->attributes['grade'] ? self::$gradeMap[$this->attributes['grade']] : '普通会员';
    }

    public function getGradeListAttribute()
    {
        $grade =  config('site.vip_grade');
        $grade_full = [];
        foreach ($grade as $k => $item) {
            $full = ['name' => User::$gradeMap[$k], 'data' => $item];
            $grade_full[] = $full;
        }
        return $grade_full;
    }

    public function getByVipAttribute()
    {
        $this->attributes['apply_at'] = isset($this->attributes['apply_at']) ?: null;
        if ($this->attributes['apply_at'] === null && $this->attributes['grade'] === self::GRADE_ONE) {
            return null;
        }
        if ($this->attributes['grade'] === self::GRADE_ZERO) {
            $carbon = Carbon::createFromTimestamp(strtotime($this->attributes['apply_at']));
            return $carbon->addDays(3)->toDateString();
        } else {
            return '您的体验会员已过期';
        }
    }

    public function getParentAttribute()
    {
        $data = [];
        $parent = User::query()->where('id', $this->attributes['invite_id'])->first();
        if ($parent) {
            $data['parent'] = $parent->name;
            $data['phone'] = $parent->phone;
        } else {
            $data['parent'] = '';
            $data['phone'] = '';
        }

        return $data;
    }

    public function getUploadDataAttribute()
    {
        if (isset($this->attributes['status']) && $this->attributes['status'] !== User::STATUS_SUCCESS) {
            if ($this->attributes['status'] === User::STATUS_AUDITING) {
                return null;
            }
            if ($this->attributes['status'] === User::STATUS_FAILED) {
                return 'idcard';
            }
            $idcard_data = json_decode($this->attributes['idcard_data'], true);
            if (!isset($idcard_data['video']) ||
                !isset($idcard_data['front_photo']) ||
                !isset($idcard_data['back_photo'])
            ) {
                return 'idcard';
            }
            if (Collection::query()->where('user_id', $this->attributes['id'])->doesntExist()) {
                return 'collection';
            }
            if (UserAddress::query()->where('user_id', $this->attributes['id'])->doesntExist()) {
                return 'address';
            }

            return null;
        }

        return null;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'idcard_data' => 'json',
        'share_rate' => 'json',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    public function getAvatarAttribute()
    {
        return $this->attributes['avatar'] ?: config('app.client_url').'/static/images/defaulavatar.jpg';
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'] ?: $this->attributes['phone'];
    }

    public function getSumInfoAttribute()
    {
        $data['integral'] = Recharge::query()
            ->where('user_id', $this->attributes['id'])
            ->where('currency_id', 2)->sum('amount');
        $data['service'] = AssetDetails::query()
            ->where('user_id', $this->attributes['id'])
            ->where('type', AssetDetails::TYPE_SERVICE)->sum('amount');
        $data['reward'] = Commission::query()->where('user_id', $this->attributes['id'])->sum('amount');

        return $data;
    }

    public function admin()
    {
        return $this->belongsTo(AdminUser::class);
    }


}
