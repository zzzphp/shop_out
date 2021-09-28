<?php

namespace App\Admin\Forms;

use App\Models\Currency;
use App\Models\Loan;
use App\Models\User;
use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;


class LoanCreateForm extends Form implements LazyRenderable
{

    use LazyWidget;

    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        $loan = Loan::query()->create([
            'user_id' => $input['user_id'],
            'currency_id' => $input['currency_id'],
            'total_amount' => $input['total_amount'], // 总本金
            'to_be_returned' => $input['total_amount'], // 代还金额 = 总本金
            'interest_rate' => $input['interest_rate'],
            'profit_rate' => $input['profit_rate'],
            'already_interest' => 0,
        ]);
        return $this
				->response()
				->success('借款添加成功，隔日凌晨生效！')
				->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $form = $this;
        $form->select('user_id', '借款账号')->options(function (){
            $values = [];
            $users = User::all();
            foreach ($users as $user) {
                $values[$user->id] = $user->phone . " [ " . $user->name ."]";
            }
            return $values;
        })->placeholder('请选择用户')->required();
        $form->select('currency_id', '借款币种')->options(function (){
            $values = [];
            $currencies = Currency::all();
            foreach ($currencies as $currency) {
                $values[$currency->id] = $currency->name;
            }
            return $values;
        })->placeholder('请选择币种')->required();
        $form->decimal('total_amount', '总借款')->required();
        $form->decimal('interest_rate','日利率（ % ）')->required()->rules('max:100');
        $form->decimal('profit_rate','还款率（ % ）')->required()->required('max:100|min:1');
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        return [
        ];
    }
}
