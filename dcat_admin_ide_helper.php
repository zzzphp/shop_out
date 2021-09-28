<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection post
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection address
     * @property Grid\Column|Collection chain
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection currency_id
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection remark
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection admin_id
     * @property Grid\Column|Collection agent_id
     * @property Grid\Column|Collection amount
     * @property Grid\Column|Collection dated
     * @property Grid\Column|Collection orders_count
     * @property Grid\Column|Collection payment_type
     * @property Grid\Column|Collection users_count
     * @property Grid\Column|Collection ability
     * @property Grid\Column|Collection admin_parent_id
     * @property Grid\Column|Collection idcard
     * @property Grid\Column|Collection image
     * @property Grid\Column|Collection legal_person
     * @property Grid\Column|Collection phone
     * @property Grid\Column|Collection sales_ratio
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection after_amount
     * @property Grid\Column|Collection front_amount
     * @property Grid\Column|Collection sign
     * @property Grid\Column|Collection link
     * @property Grid\Column|Collection sort
     * @property Grid\Column|Collection describe
     * @property Grid\Column|Collection is_show
     * @property Grid\Column|Collection level
     * @property Grid\Column|Collection order_id
     * @property Grid\Column|Collection address_data
     * @property Grid\Column|Collection chains
     * @property Grid\Column|Collection min_amount
     * @property Grid\Column|Collection service_charge
     * @property Grid\Column|Collection buy
     * @property Grid\Column|Collection change
     * @property Grid\Column|Collection high
     * @property Grid\Column|Collection isShow
     * @property Grid\Column|Collection last
     * @property Grid\Column|Collection low
     * @property Grid\Column|Collection newCoinFlag
     * @property Grid\Column|Collection rose
     * @property Grid\Column|Collection sell
     * @property Grid\Column|Collection showName
     * @property Grid\Column|Collection symbol
     * @property Grid\Column|Collection vol
     * @property Grid\Column|Collection distribute_id
     * @property Grid\Column|Collection day
     * @property Grid\Column|Collection hash_key
     * @property Grid\Column|Collection info
     * @property Grid\Column|Collection product_id
     * @property Grid\Column|Collection total_amount
     * @property Grid\Column|Collection first
     * @property Grid\Column|Collection formula
     * @property Grid\Column|Collection line_day
     * @property Grid\Column|Collection stage_id
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection base
     * @property Grid\Column|Collection due_date
     * @property Grid\Column|Collection installment_id
     * @property Grid\Column|Collection paid_at
     * @property Grid\Column|Collection pay_prove
     * @property Grid\Column|Collection payment_method
     * @property Grid\Column|Collection refund_status
     * @property Grid\Column|Collection sequence
     * @property Grid\Column|Collection count
     * @property Grid\Column|Collection no
     * @property Grid\Column|Collection attempts
     * @property Grid\Column|Collection available_at
     * @property Grid\Column|Collection reserved_at
     * @property Grid\Column|Collection interest
     * @property Grid\Column|Collection interest_rate
     * @property Grid\Column|Collection loan_id
     * @property Grid\Column|Collection profit_rate
     * @property Grid\Column|Collection to_be_returned
     * @property Grid\Column|Collection already_interest
     * @property Grid\Column|Collection last_dated
     * @property Grid\Column|Collection look_down
     * @property Grid\Column|Collection look_up
     * @property Grid\Column|Collection looks
     * @property Grid\Column|Collection stars
     * @property Grid\Column|Collection closed
     * @property Grid\Column|Collection mortgage
     * @property Grid\Column|Collection paid_prove
     * @property Grid\Column|Collection payment_price
     * @property Grid\Column|Collection profit_data
     * @property Grid\Column|Collection total_powers
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection e_name
     * @property Grid\Column|Collection rate
     * @property Grid\Column|Collection real_info
     * @property Grid\Column|Collection lock
     * @property Grid\Column|Collection num
     * @property Grid\Column|Collection power
     * @property Grid\Column|Collection power_distribute_id
     * @property Grid\Column|Collection unlock
     * @property Grid\Column|Collection available_assets
     * @property Grid\Column|Collection agreement_id
     * @property Grid\Column|Collection attributes
     * @property Grid\Column|Collection begin_at
     * @property Grid\Column|Collection category_id
     * @property Grid\Column|Collection commission
     * @property Grid\Column|Collection end_at
     * @property Grid\Column|Collection installment_data
     * @property Grid\Column|Collection labels
     * @property Grid\Column|Collection on_sale
     * @property Grid\Column|Collection original_price
     * @property Grid\Column|Collection pay_methods
     * @property Grid\Column|Collection price
     * @property Grid\Column|Collection stock
     * @property Grid\Column|Collection currency
     * @property Grid\Column|Collection recharge_prove
     * @property Grid\Column|Collection email_verified_at
     * @property Grid\Column|Collection grade
     * @property Grid\Column|Collection idcard_data
     * @property Grid\Column|Collection invite_id
     * @property Grid\Column|Collection openid
     * @property Grid\Column|Collection safe_password
     * @property Grid\Column|Collection md5file
     * @property Grid\Column|Collection min_version
     * @property Grid\Column|Collection new_version
     * @property Grid\Column|Collection size
     * @property Grid\Column|Collection terminal
     * @property Grid\Column|Collection update_description
     * @property Grid\Column|Collection url
     * @property Grid\Column|Collection frozen_amount
     * @property Grid\Column|Collection withdrawal_amount
     * @property Grid\Column|Collection actual_amount
     * @property Grid\Column|Collection coin_address
     * @property Grid\Column|Collection create_time
     * @property Grid\Column|Collection update_time
     * @property Grid\Column|Collection A
     * @property Grid\Column|Collection A1
     * @property Grid\Column|Collection A2
     * @property Grid\Column|Collection AVP
     * @property Grid\Column|Collection B1
     * @property Grid\Column|Collection B1V
     * @property Grid\Column|Collection B2
     * @property Grid\Column|Collection B2V
     * @property Grid\Column|Collection B3
     * @property Grid\Column|Collection B3V
     * @property Grid\Column|Collection B4
     * @property Grid\Column|Collection B4V
     * @property Grid\Column|Collection B5
     * @property Grid\Column|Collection B5V
     * @property Grid\Column|Collection C
     * @property Grid\Column|Collection DT
     * @property Grid\Column|Collection FS
     * @property Grid\Column|Collection H
     * @property Grid\Column|Collection HD
     * @property Grid\Column|Collection HS
     * @property Grid\Column|Collection IV
     * @property Grid\Column|Collection JS
     * @property Grid\Column|Collection L
     * @property Grid\Column|Collection LS
     * @property Grid\Column|Collection M
     * @property Grid\Column|Collection N
     * @property Grid\Column|Collection N2
     * @property Grid\Column|Collection NV
     * @property Grid\Column|Collection O
     * @property Grid\Column|Collection OV
     * @property Grid\Column|Collection P
     * @property Grid\Column|Collection QJ
     * @property Grid\Column|Collection QR
     * @property Grid\Column|Collection S
     * @property Grid\Column|Collection S1
     * @property Grid\Column|Collection S1V
     * @property Grid\Column|Collection S2
     * @property Grid\Column|Collection S2V
     * @property Grid\Column|Collection S3
     * @property Grid\Column|Collection S3V
     * @property Grid\Column|Collection S4
     * @property Grid\Column|Collection S4V
     * @property Grid\Column|Collection S5
     * @property Grid\Column|Collection S5V
     * @property Grid\Column|Collection SJ
     * @property Grid\Column|Collection SY
     * @property Grid\Column|Collection SY2
     * @property Grid\Column|Collection Tick
     * @property Grid\Column|Collection Time
     * @property Grid\Column|Collection TS
     * @property Grid\Column|Collection V
     * @property Grid\Column|Collection VF
     * @property Grid\Column|Collection YC
     * @property Grid\Column|Collection YDH
     * @property Grid\Column|Collection YHD
     * @property Grid\Column|Collection YJS
     * @property Grid\Column|Collection Z
     * @property Grid\Column|Collection Z2
     * @property Grid\Column|Collection ZD
     * @property Grid\Column|Collection ZF
     * @property Grid\Column|Collection ZS
     * @property Grid\Column|Collection ZT
     * @property Grid\Column|Collection contact
     * @property Grid\Column|Collection ctime
     * @property Grid\Column|Collection userid
     * @property Grid\Column|Collection buy_name
     * @property Grid\Column|Collection buy_userid
     * @property Grid\Column|Collection give_buy_integral
     * @property Grid\Column|Collection give_one_commission
     * @property Grid\Column|Collection give_one_name
     * @property Grid\Column|Collection give_one_userid
     * @property Grid\Column|Collection give_two_commission
     * @property Grid\Column|Collection give_two_name
     * @property Grid\Column|Collection give_two_userid
     * @property Grid\Column|Collection payment
     * @property Grid\Column|Collection suanli
     * @property Grid\Column|Collection auther
     * @property Grid\Column|Collection categroy
     * @property Grid\Column|Collection 
original_price
     * @property Grid\Column|Collection integral
     * @property Grid\Column|Collection main_chart
     * @property Grid\Column|Collection rotation_chart
     * @property Grid\Column|Collection goods_id
     * @property Grid\Column|Collection goods_name
     * @property Grid\Column|Collection logistics_no
     * @property Grid\Column|Collection use_integral
     * @property Grid\Column|Collection msg
     * @property Grid\Column|Collection delete_time
     * @property Grid\Column|Collection cate_id
     * @property Grid\Column|Collection discount_price
     * @property Grid\Column|Collection images
     * @property Grid\Column|Collection logo
     * @property Grid\Column|Collection market_price
     * @property Grid\Column|Collection sales
     * @property Grid\Column|Collection total_stock
     * @property Grid\Column|Collection virtual_sales
     * @property Grid\Column|Collection look
     * @property Grid\Column|Collection thumb_image
     * @property Grid\Column|Collection fall
     * @property Grid\Column|Collection rise
     * @property Grid\Column|Collection star
     * @property Grid\Column|Collection display
     * @property Grid\Column|Collection electric
     * @property Grid\Column|Collection fil_profit
     * @property Grid\Column|Collection get_integral
     * @property Grid\Column|Collection management_expenses
     * @property Grid\Column|Collection open_time
     * @property Grid\Column|Collection physics
     * @property Grid\Column|Collection rate_of_return
     * @property Grid\Column|Collection rmb_profit
     * @property Grid\Column|Collection stage
     * @property Grid\Column|Collection term
     * @property Grid\Column|Collection virtual
     * @property Grid\Column|Collection ftime
     * @property Grid\Column|Collection is_commission
     * @property Grid\Column|Collection pay_mode
     * @property Grid\Column|Collection payevidence_image
     * @property Grid\Column|Collection user_name
     * @property Grid\Column|Collection user_phone
     * @property Grid\Column|Collection auth_ids
     * @property Grid\Column|Collection head_img
     * @property Grid\Column|Collection login_num
     * @property Grid\Column|Collection auth_id
     * @property Grid\Column|Collection node_id
     * @property Grid\Column|Collection group
     * @property Grid\Column|Collection ip
     * @property Grid\Column|Collection method
     * @property Grid\Column|Collection useragent
     * @property Grid\Column|Collection href
     * @property Grid\Column|Collection params
     * @property Grid\Column|Collection pid
     * @property Grid\Column|Collection target
     * @property Grid\Column|Collection is_auth
     * @property Grid\Column|Collection node
     * @property Grid\Column|Collection file_ext
     * @property Grid\Column|Collection file_size
     * @property Grid\Column|Collection image_frames
     * @property Grid\Column|Collection image_height
     * @property Grid\Column|Collection image_type
     * @property Grid\Column|Collection image_width
     * @property Grid\Column|Collection mime_type
     * @property Grid\Column|Collection original_name
     * @property Grid\Column|Collection sha1
     * @property Grid\Column|Collection upload_time
     * @property Grid\Column|Collection upload_type
     * @property Grid\Column|Collection available_commission
     * @property Grid\Column|Collection fil_assets
     * @property Grid\Column|Collection fil_available_assets
     * @property Grid\Column|Collection fil_freezing_assets
     * @property Grid\Column|Collection freezing_commission
     * @property Grid\Column|Collection headimgurl
     * @property Grid\Column|Collection idcard_back_image
     * @property Grid\Column|Collection idcard_front_image
     * @property Grid\Column|Collection pay_password
     * @property Grid\Column|Collection superintendent
     * @property Grid\Column|Collection uptime
     * @property Grid\Column|Collection usdt_assets
     * @property Grid\Column|Collection usdt_available_assets
     * @property Grid\Column|Collection usdt_freezing_assets
     * @property Grid\Column|Collection bankname
     * @property Grid\Column|Collection card
     * @property Grid\Column|Collection extract_type
     * @property Grid\Column|Collection is_payment
     * @property Grid\Column|Collection money
     * @property Grid\Column|Collection payee
     * @property Grid\Column|Collection poundage
     * @property Grid\Column|Collection prove_image
     * @property Grid\Column|Collection idcard_back
     * @property Grid\Column|Collection idcard_front
     * @property Grid\Column|Collection signed_photo
     * @property Grid\Column|Collection cycle
     * @property Grid\Column|Collection first_cycle
     * @property Grid\Column|Collection mode
     * @property Grid\Column|Collection mortgage_advance
     * @property Grid\Column|Collection mortgage_user
     * @property Grid\Column|Collection create_date
     * @property Grid\Column|Collection distributeid
     * @property Grid\Column|Collection assets
     * @property Grid\Column|Collection earnings
     * @property Grid\Column|Collection earnings_lock
     * @property Grid\Column|Collection earnings_unlock
     * @property Grid\Column|Collection freezing_assets
     * @property Grid\Column|Collection suanli2
     * @property Grid\Column|Collection suanli3
     * @property Grid\Column|Collection suanli4
     * @property Grid\Column|Collection suanli5
     * @property Grid\Column|Collection transfer_fil
     * @property Grid\Column|Collection uid
     * @property Grid\Column|Collection is_extract
     * @property Grid\Column|Collection coin
     * @property Grid\Column|Collection is_tranfer
     * @property Grid\Column|Collection begin
     * @property Grid\Column|Collection every_t
     * @property Grid\Column|Collection filecoin
     * @property Grid\Column|Collection release_date
     *
     * @method Grid\Column|Collection post(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection address(string $label = null)
     * @method Grid\Column|Collection chain(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection currency_id(string $label = null)
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection remark(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection admin_id(string $label = null)
     * @method Grid\Column|Collection agent_id(string $label = null)
     * @method Grid\Column|Collection amount(string $label = null)
     * @method Grid\Column|Collection dated(string $label = null)
     * @method Grid\Column|Collection orders_count(string $label = null)
     * @method Grid\Column|Collection payment_type(string $label = null)
     * @method Grid\Column|Collection users_count(string $label = null)
     * @method Grid\Column|Collection ability(string $label = null)
     * @method Grid\Column|Collection admin_parent_id(string $label = null)
     * @method Grid\Column|Collection idcard(string $label = null)
     * @method Grid\Column|Collection image(string $label = null)
     * @method Grid\Column|Collection legal_person(string $label = null)
     * @method Grid\Column|Collection phone(string $label = null)
     * @method Grid\Column|Collection sales_ratio(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection after_amount(string $label = null)
     * @method Grid\Column|Collection front_amount(string $label = null)
     * @method Grid\Column|Collection sign(string $label = null)
     * @method Grid\Column|Collection link(string $label = null)
     * @method Grid\Column|Collection sort(string $label = null)
     * @method Grid\Column|Collection describe(string $label = null)
     * @method Grid\Column|Collection is_show(string $label = null)
     * @method Grid\Column|Collection level(string $label = null)
     * @method Grid\Column|Collection order_id(string $label = null)
     * @method Grid\Column|Collection address_data(string $label = null)
     * @method Grid\Column|Collection chains(string $label = null)
     * @method Grid\Column|Collection min_amount(string $label = null)
     * @method Grid\Column|Collection service_charge(string $label = null)
     * @method Grid\Column|Collection buy(string $label = null)
     * @method Grid\Column|Collection change(string $label = null)
     * @method Grid\Column|Collection high(string $label = null)
     * @method Grid\Column|Collection isShow(string $label = null)
     * @method Grid\Column|Collection last(string $label = null)
     * @method Grid\Column|Collection low(string $label = null)
     * @method Grid\Column|Collection newCoinFlag(string $label = null)
     * @method Grid\Column|Collection rose(string $label = null)
     * @method Grid\Column|Collection sell(string $label = null)
     * @method Grid\Column|Collection showName(string $label = null)
     * @method Grid\Column|Collection symbol(string $label = null)
     * @method Grid\Column|Collection vol(string $label = null)
     * @method Grid\Column|Collection distribute_id(string $label = null)
     * @method Grid\Column|Collection day(string $label = null)
     * @method Grid\Column|Collection hash_key(string $label = null)
     * @method Grid\Column|Collection info(string $label = null)
     * @method Grid\Column|Collection product_id(string $label = null)
     * @method Grid\Column|Collection total_amount(string $label = null)
     * @method Grid\Column|Collection first(string $label = null)
     * @method Grid\Column|Collection formula(string $label = null)
     * @method Grid\Column|Collection line_day(string $label = null)
     * @method Grid\Column|Collection stage_id(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection base(string $label = null)
     * @method Grid\Column|Collection due_date(string $label = null)
     * @method Grid\Column|Collection installment_id(string $label = null)
     * @method Grid\Column|Collection paid_at(string $label = null)
     * @method Grid\Column|Collection pay_prove(string $label = null)
     * @method Grid\Column|Collection payment_method(string $label = null)
     * @method Grid\Column|Collection refund_status(string $label = null)
     * @method Grid\Column|Collection sequence(string $label = null)
     * @method Grid\Column|Collection count(string $label = null)
     * @method Grid\Column|Collection no(string $label = null)
     * @method Grid\Column|Collection attempts(string $label = null)
     * @method Grid\Column|Collection available_at(string $label = null)
     * @method Grid\Column|Collection reserved_at(string $label = null)
     * @method Grid\Column|Collection interest(string $label = null)
     * @method Grid\Column|Collection interest_rate(string $label = null)
     * @method Grid\Column|Collection loan_id(string $label = null)
     * @method Grid\Column|Collection profit_rate(string $label = null)
     * @method Grid\Column|Collection to_be_returned(string $label = null)
     * @method Grid\Column|Collection already_interest(string $label = null)
     * @method Grid\Column|Collection last_dated(string $label = null)
     * @method Grid\Column|Collection look_down(string $label = null)
     * @method Grid\Column|Collection look_up(string $label = null)
     * @method Grid\Column|Collection looks(string $label = null)
     * @method Grid\Column|Collection stars(string $label = null)
     * @method Grid\Column|Collection closed(string $label = null)
     * @method Grid\Column|Collection mortgage(string $label = null)
     * @method Grid\Column|Collection paid_prove(string $label = null)
     * @method Grid\Column|Collection payment_price(string $label = null)
     * @method Grid\Column|Collection profit_data(string $label = null)
     * @method Grid\Column|Collection total_powers(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection e_name(string $label = null)
     * @method Grid\Column|Collection rate(string $label = null)
     * @method Grid\Column|Collection real_info(string $label = null)
     * @method Grid\Column|Collection lock(string $label = null)
     * @method Grid\Column|Collection num(string $label = null)
     * @method Grid\Column|Collection power(string $label = null)
     * @method Grid\Column|Collection power_distribute_id(string $label = null)
     * @method Grid\Column|Collection unlock(string $label = null)
     * @method Grid\Column|Collection available_assets(string $label = null)
     * @method Grid\Column|Collection agreement_id(string $label = null)
     * @method Grid\Column|Collection attributes(string $label = null)
     * @method Grid\Column|Collection begin_at(string $label = null)
     * @method Grid\Column|Collection category_id(string $label = null)
     * @method Grid\Column|Collection commission(string $label = null)
     * @method Grid\Column|Collection end_at(string $label = null)
     * @method Grid\Column|Collection installment_data(string $label = null)
     * @method Grid\Column|Collection labels(string $label = null)
     * @method Grid\Column|Collection on_sale(string $label = null)
     * @method Grid\Column|Collection original_price(string $label = null)
     * @method Grid\Column|Collection pay_methods(string $label = null)
     * @method Grid\Column|Collection price(string $label = null)
     * @method Grid\Column|Collection stock(string $label = null)
     * @method Grid\Column|Collection currency(string $label = null)
     * @method Grid\Column|Collection recharge_prove(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     * @method Grid\Column|Collection grade(string $label = null)
     * @method Grid\Column|Collection idcard_data(string $label = null)
     * @method Grid\Column|Collection invite_id(string $label = null)
     * @method Grid\Column|Collection openid(string $label = null)
     * @method Grid\Column|Collection safe_password(string $label = null)
     * @method Grid\Column|Collection md5file(string $label = null)
     * @method Grid\Column|Collection min_version(string $label = null)
     * @method Grid\Column|Collection new_version(string $label = null)
     * @method Grid\Column|Collection size(string $label = null)
     * @method Grid\Column|Collection terminal(string $label = null)
     * @method Grid\Column|Collection update_description(string $label = null)
     * @method Grid\Column|Collection url(string $label = null)
     * @method Grid\Column|Collection frozen_amount(string $label = null)
     * @method Grid\Column|Collection withdrawal_amount(string $label = null)
     * @method Grid\Column|Collection actual_amount(string $label = null)
     * @method Grid\Column|Collection coin_address(string $label = null)
     * @method Grid\Column|Collection create_time(string $label = null)
     * @method Grid\Column|Collection update_time(string $label = null)
     * @method Grid\Column|Collection A(string $label = null)
     * @method Grid\Column|Collection A1(string $label = null)
     * @method Grid\Column|Collection A2(string $label = null)
     * @method Grid\Column|Collection AVP(string $label = null)
     * @method Grid\Column|Collection B1(string $label = null)
     * @method Grid\Column|Collection B1V(string $label = null)
     * @method Grid\Column|Collection B2(string $label = null)
     * @method Grid\Column|Collection B2V(string $label = null)
     * @method Grid\Column|Collection B3(string $label = null)
     * @method Grid\Column|Collection B3V(string $label = null)
     * @method Grid\Column|Collection B4(string $label = null)
     * @method Grid\Column|Collection B4V(string $label = null)
     * @method Grid\Column|Collection B5(string $label = null)
     * @method Grid\Column|Collection B5V(string $label = null)
     * @method Grid\Column|Collection C(string $label = null)
     * @method Grid\Column|Collection DT(string $label = null)
     * @method Grid\Column|Collection FS(string $label = null)
     * @method Grid\Column|Collection H(string $label = null)
     * @method Grid\Column|Collection HD(string $label = null)
     * @method Grid\Column|Collection HS(string $label = null)
     * @method Grid\Column|Collection IV(string $label = null)
     * @method Grid\Column|Collection JS(string $label = null)
     * @method Grid\Column|Collection L(string $label = null)
     * @method Grid\Column|Collection LS(string $label = null)
     * @method Grid\Column|Collection M(string $label = null)
     * @method Grid\Column|Collection N(string $label = null)
     * @method Grid\Column|Collection N2(string $label = null)
     * @method Grid\Column|Collection NV(string $label = null)
     * @method Grid\Column|Collection O(string $label = null)
     * @method Grid\Column|Collection OV(string $label = null)
     * @method Grid\Column|Collection P(string $label = null)
     * @method Grid\Column|Collection QJ(string $label = null)
     * @method Grid\Column|Collection QR(string $label = null)
     * @method Grid\Column|Collection S(string $label = null)
     * @method Grid\Column|Collection S1(string $label = null)
     * @method Grid\Column|Collection S1V(string $label = null)
     * @method Grid\Column|Collection S2(string $label = null)
     * @method Grid\Column|Collection S2V(string $label = null)
     * @method Grid\Column|Collection S3(string $label = null)
     * @method Grid\Column|Collection S3V(string $label = null)
     * @method Grid\Column|Collection S4(string $label = null)
     * @method Grid\Column|Collection S4V(string $label = null)
     * @method Grid\Column|Collection S5(string $label = null)
     * @method Grid\Column|Collection S5V(string $label = null)
     * @method Grid\Column|Collection SJ(string $label = null)
     * @method Grid\Column|Collection SY(string $label = null)
     * @method Grid\Column|Collection SY2(string $label = null)
     * @method Grid\Column|Collection Tick(string $label = null)
     * @method Grid\Column|Collection Time(string $label = null)
     * @method Grid\Column|Collection TS(string $label = null)
     * @method Grid\Column|Collection V(string $label = null)
     * @method Grid\Column|Collection VF(string $label = null)
     * @method Grid\Column|Collection YC(string $label = null)
     * @method Grid\Column|Collection YDH(string $label = null)
     * @method Grid\Column|Collection YHD(string $label = null)
     * @method Grid\Column|Collection YJS(string $label = null)
     * @method Grid\Column|Collection Z(string $label = null)
     * @method Grid\Column|Collection Z2(string $label = null)
     * @method Grid\Column|Collection ZD(string $label = null)
     * @method Grid\Column|Collection ZF(string $label = null)
     * @method Grid\Column|Collection ZS(string $label = null)
     * @method Grid\Column|Collection ZT(string $label = null)
     * @method Grid\Column|Collection contact(string $label = null)
     * @method Grid\Column|Collection ctime(string $label = null)
     * @method Grid\Column|Collection userid(string $label = null)
     * @method Grid\Column|Collection buy_name(string $label = null)
     * @method Grid\Column|Collection buy_userid(string $label = null)
     * @method Grid\Column|Collection give_buy_integral(string $label = null)
     * @method Grid\Column|Collection give_one_commission(string $label = null)
     * @method Grid\Column|Collection give_one_name(string $label = null)
     * @method Grid\Column|Collection give_one_userid(string $label = null)
     * @method Grid\Column|Collection give_two_commission(string $label = null)
     * @method Grid\Column|Collection give_two_name(string $label = null)
     * @method Grid\Column|Collection give_two_userid(string $label = null)
     * @method Grid\Column|Collection payment(string $label = null)
     * @method Grid\Column|Collection suanli(string $label = null)
     * @method Grid\Column|Collection auther(string $label = null)
     * @method Grid\Column|Collection categroy(string $label = null)
     * @method Grid\Column|Collection 
original_price(string $label = null)
     * @method Grid\Column|Collection integral(string $label = null)
     * @method Grid\Column|Collection main_chart(string $label = null)
     * @method Grid\Column|Collection rotation_chart(string $label = null)
     * @method Grid\Column|Collection goods_id(string $label = null)
     * @method Grid\Column|Collection goods_name(string $label = null)
     * @method Grid\Column|Collection logistics_no(string $label = null)
     * @method Grid\Column|Collection use_integral(string $label = null)
     * @method Grid\Column|Collection msg(string $label = null)
     * @method Grid\Column|Collection delete_time(string $label = null)
     * @method Grid\Column|Collection cate_id(string $label = null)
     * @method Grid\Column|Collection discount_price(string $label = null)
     * @method Grid\Column|Collection images(string $label = null)
     * @method Grid\Column|Collection logo(string $label = null)
     * @method Grid\Column|Collection market_price(string $label = null)
     * @method Grid\Column|Collection sales(string $label = null)
     * @method Grid\Column|Collection total_stock(string $label = null)
     * @method Grid\Column|Collection virtual_sales(string $label = null)
     * @method Grid\Column|Collection look(string $label = null)
     * @method Grid\Column|Collection thumb_image(string $label = null)
     * @method Grid\Column|Collection fall(string $label = null)
     * @method Grid\Column|Collection rise(string $label = null)
     * @method Grid\Column|Collection star(string $label = null)
     * @method Grid\Column|Collection display(string $label = null)
     * @method Grid\Column|Collection electric(string $label = null)
     * @method Grid\Column|Collection fil_profit(string $label = null)
     * @method Grid\Column|Collection get_integral(string $label = null)
     * @method Grid\Column|Collection management_expenses(string $label = null)
     * @method Grid\Column|Collection open_time(string $label = null)
     * @method Grid\Column|Collection physics(string $label = null)
     * @method Grid\Column|Collection rate_of_return(string $label = null)
     * @method Grid\Column|Collection rmb_profit(string $label = null)
     * @method Grid\Column|Collection stage(string $label = null)
     * @method Grid\Column|Collection term(string $label = null)
     * @method Grid\Column|Collection virtual(string $label = null)
     * @method Grid\Column|Collection ftime(string $label = null)
     * @method Grid\Column|Collection is_commission(string $label = null)
     * @method Grid\Column|Collection pay_mode(string $label = null)
     * @method Grid\Column|Collection payevidence_image(string $label = null)
     * @method Grid\Column|Collection user_name(string $label = null)
     * @method Grid\Column|Collection user_phone(string $label = null)
     * @method Grid\Column|Collection auth_ids(string $label = null)
     * @method Grid\Column|Collection head_img(string $label = null)
     * @method Grid\Column|Collection login_num(string $label = null)
     * @method Grid\Column|Collection auth_id(string $label = null)
     * @method Grid\Column|Collection node_id(string $label = null)
     * @method Grid\Column|Collection group(string $label = null)
     * @method Grid\Column|Collection ip(string $label = null)
     * @method Grid\Column|Collection method(string $label = null)
     * @method Grid\Column|Collection useragent(string $label = null)
     * @method Grid\Column|Collection href(string $label = null)
     * @method Grid\Column|Collection params(string $label = null)
     * @method Grid\Column|Collection pid(string $label = null)
     * @method Grid\Column|Collection target(string $label = null)
     * @method Grid\Column|Collection is_auth(string $label = null)
     * @method Grid\Column|Collection node(string $label = null)
     * @method Grid\Column|Collection file_ext(string $label = null)
     * @method Grid\Column|Collection file_size(string $label = null)
     * @method Grid\Column|Collection image_frames(string $label = null)
     * @method Grid\Column|Collection image_height(string $label = null)
     * @method Grid\Column|Collection image_type(string $label = null)
     * @method Grid\Column|Collection image_width(string $label = null)
     * @method Grid\Column|Collection mime_type(string $label = null)
     * @method Grid\Column|Collection original_name(string $label = null)
     * @method Grid\Column|Collection sha1(string $label = null)
     * @method Grid\Column|Collection upload_time(string $label = null)
     * @method Grid\Column|Collection upload_type(string $label = null)
     * @method Grid\Column|Collection available_commission(string $label = null)
     * @method Grid\Column|Collection fil_assets(string $label = null)
     * @method Grid\Column|Collection fil_available_assets(string $label = null)
     * @method Grid\Column|Collection fil_freezing_assets(string $label = null)
     * @method Grid\Column|Collection freezing_commission(string $label = null)
     * @method Grid\Column|Collection headimgurl(string $label = null)
     * @method Grid\Column|Collection idcard_back_image(string $label = null)
     * @method Grid\Column|Collection idcard_front_image(string $label = null)
     * @method Grid\Column|Collection pay_password(string $label = null)
     * @method Grid\Column|Collection superintendent(string $label = null)
     * @method Grid\Column|Collection uptime(string $label = null)
     * @method Grid\Column|Collection usdt_assets(string $label = null)
     * @method Grid\Column|Collection usdt_available_assets(string $label = null)
     * @method Grid\Column|Collection usdt_freezing_assets(string $label = null)
     * @method Grid\Column|Collection bankname(string $label = null)
     * @method Grid\Column|Collection card(string $label = null)
     * @method Grid\Column|Collection extract_type(string $label = null)
     * @method Grid\Column|Collection is_payment(string $label = null)
     * @method Grid\Column|Collection money(string $label = null)
     * @method Grid\Column|Collection payee(string $label = null)
     * @method Grid\Column|Collection poundage(string $label = null)
     * @method Grid\Column|Collection prove_image(string $label = null)
     * @method Grid\Column|Collection idcard_back(string $label = null)
     * @method Grid\Column|Collection idcard_front(string $label = null)
     * @method Grid\Column|Collection signed_photo(string $label = null)
     * @method Grid\Column|Collection cycle(string $label = null)
     * @method Grid\Column|Collection first_cycle(string $label = null)
     * @method Grid\Column|Collection mode(string $label = null)
     * @method Grid\Column|Collection mortgage_advance(string $label = null)
     * @method Grid\Column|Collection mortgage_user(string $label = null)
     * @method Grid\Column|Collection create_date(string $label = null)
     * @method Grid\Column|Collection distributeid(string $label = null)
     * @method Grid\Column|Collection assets(string $label = null)
     * @method Grid\Column|Collection earnings(string $label = null)
     * @method Grid\Column|Collection earnings_lock(string $label = null)
     * @method Grid\Column|Collection earnings_unlock(string $label = null)
     * @method Grid\Column|Collection freezing_assets(string $label = null)
     * @method Grid\Column|Collection suanli2(string $label = null)
     * @method Grid\Column|Collection suanli3(string $label = null)
     * @method Grid\Column|Collection suanli4(string $label = null)
     * @method Grid\Column|Collection suanli5(string $label = null)
     * @method Grid\Column|Collection transfer_fil(string $label = null)
     * @method Grid\Column|Collection uid(string $label = null)
     * @method Grid\Column|Collection is_extract(string $label = null)
     * @method Grid\Column|Collection coin(string $label = null)
     * @method Grid\Column|Collection is_tranfer(string $label = null)
     * @method Grid\Column|Collection begin(string $label = null)
     * @method Grid\Column|Collection every_t(string $label = null)
     * @method Grid\Column|Collection filecoin(string $label = null)
     * @method Grid\Column|Collection release_date(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection post
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection address
     * @property Show\Field|Collection chain
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection currency_id
     * @property Show\Field|Collection id
     * @property Show\Field|Collection remark
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection version
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection order
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection password
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection username
     * @property Show\Field|Collection admin_id
     * @property Show\Field|Collection agent_id
     * @property Show\Field|Collection amount
     * @property Show\Field|Collection dated
     * @property Show\Field|Collection orders_count
     * @property Show\Field|Collection payment_type
     * @property Show\Field|Collection users_count
     * @property Show\Field|Collection ability
     * @property Show\Field|Collection admin_parent_id
     * @property Show\Field|Collection idcard
     * @property Show\Field|Collection image
     * @property Show\Field|Collection legal_person
     * @property Show\Field|Collection phone
     * @property Show\Field|Collection sales_ratio
     * @property Show\Field|Collection content
     * @property Show\Field|Collection status
     * @property Show\Field|Collection after_amount
     * @property Show\Field|Collection front_amount
     * @property Show\Field|Collection sign
     * @property Show\Field|Collection link
     * @property Show\Field|Collection sort
     * @property Show\Field|Collection describe
     * @property Show\Field|Collection is_show
     * @property Show\Field|Collection level
     * @property Show\Field|Collection order_id
     * @property Show\Field|Collection address_data
     * @property Show\Field|Collection chains
     * @property Show\Field|Collection min_amount
     * @property Show\Field|Collection service_charge
     * @property Show\Field|Collection buy
     * @property Show\Field|Collection change
     * @property Show\Field|Collection high
     * @property Show\Field|Collection isShow
     * @property Show\Field|Collection last
     * @property Show\Field|Collection low
     * @property Show\Field|Collection newCoinFlag
     * @property Show\Field|Collection rose
     * @property Show\Field|Collection sell
     * @property Show\Field|Collection showName
     * @property Show\Field|Collection symbol
     * @property Show\Field|Collection vol
     * @property Show\Field|Collection distribute_id
     * @property Show\Field|Collection day
     * @property Show\Field|Collection hash_key
     * @property Show\Field|Collection info
     * @property Show\Field|Collection product_id
     * @property Show\Field|Collection total_amount
     * @property Show\Field|Collection first
     * @property Show\Field|Collection formula
     * @property Show\Field|Collection line_day
     * @property Show\Field|Collection stage_id
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection base
     * @property Show\Field|Collection due_date
     * @property Show\Field|Collection installment_id
     * @property Show\Field|Collection paid_at
     * @property Show\Field|Collection pay_prove
     * @property Show\Field|Collection payment_method
     * @property Show\Field|Collection refund_status
     * @property Show\Field|Collection sequence
     * @property Show\Field|Collection count
     * @property Show\Field|Collection no
     * @property Show\Field|Collection attempts
     * @property Show\Field|Collection available_at
     * @property Show\Field|Collection reserved_at
     * @property Show\Field|Collection interest
     * @property Show\Field|Collection interest_rate
     * @property Show\Field|Collection loan_id
     * @property Show\Field|Collection profit_rate
     * @property Show\Field|Collection to_be_returned
     * @property Show\Field|Collection already_interest
     * @property Show\Field|Collection last_dated
     * @property Show\Field|Collection look_down
     * @property Show\Field|Collection look_up
     * @property Show\Field|Collection looks
     * @property Show\Field|Collection stars
     * @property Show\Field|Collection closed
     * @property Show\Field|Collection mortgage
     * @property Show\Field|Collection paid_prove
     * @property Show\Field|Collection payment_price
     * @property Show\Field|Collection profit_data
     * @property Show\Field|Collection total_powers
     * @property Show\Field|Collection email
     * @property Show\Field|Collection token
     * @property Show\Field|Collection e_name
     * @property Show\Field|Collection rate
     * @property Show\Field|Collection real_info
     * @property Show\Field|Collection lock
     * @property Show\Field|Collection num
     * @property Show\Field|Collection power
     * @property Show\Field|Collection power_distribute_id
     * @property Show\Field|Collection unlock
     * @property Show\Field|Collection available_assets
     * @property Show\Field|Collection agreement_id
     * @property Show\Field|Collection attributes
     * @property Show\Field|Collection begin_at
     * @property Show\Field|Collection category_id
     * @property Show\Field|Collection commission
     * @property Show\Field|Collection end_at
     * @property Show\Field|Collection installment_data
     * @property Show\Field|Collection labels
     * @property Show\Field|Collection on_sale
     * @property Show\Field|Collection original_price
     * @property Show\Field|Collection pay_methods
     * @property Show\Field|Collection price
     * @property Show\Field|Collection stock
     * @property Show\Field|Collection currency
     * @property Show\Field|Collection recharge_prove
     * @property Show\Field|Collection email_verified_at
     * @property Show\Field|Collection grade
     * @property Show\Field|Collection idcard_data
     * @property Show\Field|Collection invite_id
     * @property Show\Field|Collection openid
     * @property Show\Field|Collection safe_password
     * @property Show\Field|Collection md5file
     * @property Show\Field|Collection min_version
     * @property Show\Field|Collection new_version
     * @property Show\Field|Collection size
     * @property Show\Field|Collection terminal
     * @property Show\Field|Collection update_description
     * @property Show\Field|Collection url
     * @property Show\Field|Collection frozen_amount
     * @property Show\Field|Collection withdrawal_amount
     * @property Show\Field|Collection actual_amount
     * @property Show\Field|Collection coin_address
     * @property Show\Field|Collection create_time
     * @property Show\Field|Collection update_time
     * @property Show\Field|Collection A
     * @property Show\Field|Collection A1
     * @property Show\Field|Collection A2
     * @property Show\Field|Collection AVP
     * @property Show\Field|Collection B1
     * @property Show\Field|Collection B1V
     * @property Show\Field|Collection B2
     * @property Show\Field|Collection B2V
     * @property Show\Field|Collection B3
     * @property Show\Field|Collection B3V
     * @property Show\Field|Collection B4
     * @property Show\Field|Collection B4V
     * @property Show\Field|Collection B5
     * @property Show\Field|Collection B5V
     * @property Show\Field|Collection C
     * @property Show\Field|Collection DT
     * @property Show\Field|Collection FS
     * @property Show\Field|Collection H
     * @property Show\Field|Collection HD
     * @property Show\Field|Collection HS
     * @property Show\Field|Collection IV
     * @property Show\Field|Collection JS
     * @property Show\Field|Collection L
     * @property Show\Field|Collection LS
     * @property Show\Field|Collection M
     * @property Show\Field|Collection N
     * @property Show\Field|Collection N2
     * @property Show\Field|Collection NV
     * @property Show\Field|Collection O
     * @property Show\Field|Collection OV
     * @property Show\Field|Collection P
     * @property Show\Field|Collection QJ
     * @property Show\Field|Collection QR
     * @property Show\Field|Collection S
     * @property Show\Field|Collection S1
     * @property Show\Field|Collection S1V
     * @property Show\Field|Collection S2
     * @property Show\Field|Collection S2V
     * @property Show\Field|Collection S3
     * @property Show\Field|Collection S3V
     * @property Show\Field|Collection S4
     * @property Show\Field|Collection S4V
     * @property Show\Field|Collection S5
     * @property Show\Field|Collection S5V
     * @property Show\Field|Collection SJ
     * @property Show\Field|Collection SY
     * @property Show\Field|Collection SY2
     * @property Show\Field|Collection Tick
     * @property Show\Field|Collection Time
     * @property Show\Field|Collection TS
     * @property Show\Field|Collection V
     * @property Show\Field|Collection VF
     * @property Show\Field|Collection YC
     * @property Show\Field|Collection YDH
     * @property Show\Field|Collection YHD
     * @property Show\Field|Collection YJS
     * @property Show\Field|Collection Z
     * @property Show\Field|Collection Z2
     * @property Show\Field|Collection ZD
     * @property Show\Field|Collection ZF
     * @property Show\Field|Collection ZS
     * @property Show\Field|Collection ZT
     * @property Show\Field|Collection contact
     * @property Show\Field|Collection ctime
     * @property Show\Field|Collection userid
     * @property Show\Field|Collection buy_name
     * @property Show\Field|Collection buy_userid
     * @property Show\Field|Collection give_buy_integral
     * @property Show\Field|Collection give_one_commission
     * @property Show\Field|Collection give_one_name
     * @property Show\Field|Collection give_one_userid
     * @property Show\Field|Collection give_two_commission
     * @property Show\Field|Collection give_two_name
     * @property Show\Field|Collection give_two_userid
     * @property Show\Field|Collection payment
     * @property Show\Field|Collection suanli
     * @property Show\Field|Collection auther
     * @property Show\Field|Collection categroy
     * @property Show\Field|Collection 
original_price
     * @property Show\Field|Collection integral
     * @property Show\Field|Collection main_chart
     * @property Show\Field|Collection rotation_chart
     * @property Show\Field|Collection goods_id
     * @property Show\Field|Collection goods_name
     * @property Show\Field|Collection logistics_no
     * @property Show\Field|Collection use_integral
     * @property Show\Field|Collection msg
     * @property Show\Field|Collection delete_time
     * @property Show\Field|Collection cate_id
     * @property Show\Field|Collection discount_price
     * @property Show\Field|Collection images
     * @property Show\Field|Collection logo
     * @property Show\Field|Collection market_price
     * @property Show\Field|Collection sales
     * @property Show\Field|Collection total_stock
     * @property Show\Field|Collection virtual_sales
     * @property Show\Field|Collection look
     * @property Show\Field|Collection thumb_image
     * @property Show\Field|Collection fall
     * @property Show\Field|Collection rise
     * @property Show\Field|Collection star
     * @property Show\Field|Collection display
     * @property Show\Field|Collection electric
     * @property Show\Field|Collection fil_profit
     * @property Show\Field|Collection get_integral
     * @property Show\Field|Collection management_expenses
     * @property Show\Field|Collection open_time
     * @property Show\Field|Collection physics
     * @property Show\Field|Collection rate_of_return
     * @property Show\Field|Collection rmb_profit
     * @property Show\Field|Collection stage
     * @property Show\Field|Collection term
     * @property Show\Field|Collection virtual
     * @property Show\Field|Collection ftime
     * @property Show\Field|Collection is_commission
     * @property Show\Field|Collection pay_mode
     * @property Show\Field|Collection payevidence_image
     * @property Show\Field|Collection user_name
     * @property Show\Field|Collection user_phone
     * @property Show\Field|Collection auth_ids
     * @property Show\Field|Collection head_img
     * @property Show\Field|Collection login_num
     * @property Show\Field|Collection auth_id
     * @property Show\Field|Collection node_id
     * @property Show\Field|Collection group
     * @property Show\Field|Collection ip
     * @property Show\Field|Collection method
     * @property Show\Field|Collection useragent
     * @property Show\Field|Collection href
     * @property Show\Field|Collection params
     * @property Show\Field|Collection pid
     * @property Show\Field|Collection target
     * @property Show\Field|Collection is_auth
     * @property Show\Field|Collection node
     * @property Show\Field|Collection file_ext
     * @property Show\Field|Collection file_size
     * @property Show\Field|Collection image_frames
     * @property Show\Field|Collection image_height
     * @property Show\Field|Collection image_type
     * @property Show\Field|Collection image_width
     * @property Show\Field|Collection mime_type
     * @property Show\Field|Collection original_name
     * @property Show\Field|Collection sha1
     * @property Show\Field|Collection upload_time
     * @property Show\Field|Collection upload_type
     * @property Show\Field|Collection available_commission
     * @property Show\Field|Collection fil_assets
     * @property Show\Field|Collection fil_available_assets
     * @property Show\Field|Collection fil_freezing_assets
     * @property Show\Field|Collection freezing_commission
     * @property Show\Field|Collection headimgurl
     * @property Show\Field|Collection idcard_back_image
     * @property Show\Field|Collection idcard_front_image
     * @property Show\Field|Collection pay_password
     * @property Show\Field|Collection superintendent
     * @property Show\Field|Collection uptime
     * @property Show\Field|Collection usdt_assets
     * @property Show\Field|Collection usdt_available_assets
     * @property Show\Field|Collection usdt_freezing_assets
     * @property Show\Field|Collection bankname
     * @property Show\Field|Collection card
     * @property Show\Field|Collection extract_type
     * @property Show\Field|Collection is_payment
     * @property Show\Field|Collection money
     * @property Show\Field|Collection payee
     * @property Show\Field|Collection poundage
     * @property Show\Field|Collection prove_image
     * @property Show\Field|Collection idcard_back
     * @property Show\Field|Collection idcard_front
     * @property Show\Field|Collection signed_photo
     * @property Show\Field|Collection cycle
     * @property Show\Field|Collection first_cycle
     * @property Show\Field|Collection mode
     * @property Show\Field|Collection mortgage_advance
     * @property Show\Field|Collection mortgage_user
     * @property Show\Field|Collection create_date
     * @property Show\Field|Collection distributeid
     * @property Show\Field|Collection assets
     * @property Show\Field|Collection earnings
     * @property Show\Field|Collection earnings_lock
     * @property Show\Field|Collection earnings_unlock
     * @property Show\Field|Collection freezing_assets
     * @property Show\Field|Collection suanli2
     * @property Show\Field|Collection suanli3
     * @property Show\Field|Collection suanli4
     * @property Show\Field|Collection suanli5
     * @property Show\Field|Collection transfer_fil
     * @property Show\Field|Collection uid
     * @property Show\Field|Collection is_extract
     * @property Show\Field|Collection coin
     * @property Show\Field|Collection is_tranfer
     * @property Show\Field|Collection begin
     * @property Show\Field|Collection every_t
     * @property Show\Field|Collection filecoin
     * @property Show\Field|Collection release_date
     *
     * @method Show\Field|Collection post(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection address(string $label = null)
     * @method Show\Field|Collection chain(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection currency_id(string $label = null)
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection remark(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection admin_id(string $label = null)
     * @method Show\Field|Collection agent_id(string $label = null)
     * @method Show\Field|Collection amount(string $label = null)
     * @method Show\Field|Collection dated(string $label = null)
     * @method Show\Field|Collection orders_count(string $label = null)
     * @method Show\Field|Collection payment_type(string $label = null)
     * @method Show\Field|Collection users_count(string $label = null)
     * @method Show\Field|Collection ability(string $label = null)
     * @method Show\Field|Collection admin_parent_id(string $label = null)
     * @method Show\Field|Collection idcard(string $label = null)
     * @method Show\Field|Collection image(string $label = null)
     * @method Show\Field|Collection legal_person(string $label = null)
     * @method Show\Field|Collection phone(string $label = null)
     * @method Show\Field|Collection sales_ratio(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection after_amount(string $label = null)
     * @method Show\Field|Collection front_amount(string $label = null)
     * @method Show\Field|Collection sign(string $label = null)
     * @method Show\Field|Collection link(string $label = null)
     * @method Show\Field|Collection sort(string $label = null)
     * @method Show\Field|Collection describe(string $label = null)
     * @method Show\Field|Collection is_show(string $label = null)
     * @method Show\Field|Collection level(string $label = null)
     * @method Show\Field|Collection order_id(string $label = null)
     * @method Show\Field|Collection address_data(string $label = null)
     * @method Show\Field|Collection chains(string $label = null)
     * @method Show\Field|Collection min_amount(string $label = null)
     * @method Show\Field|Collection service_charge(string $label = null)
     * @method Show\Field|Collection buy(string $label = null)
     * @method Show\Field|Collection change(string $label = null)
     * @method Show\Field|Collection high(string $label = null)
     * @method Show\Field|Collection isShow(string $label = null)
     * @method Show\Field|Collection last(string $label = null)
     * @method Show\Field|Collection low(string $label = null)
     * @method Show\Field|Collection newCoinFlag(string $label = null)
     * @method Show\Field|Collection rose(string $label = null)
     * @method Show\Field|Collection sell(string $label = null)
     * @method Show\Field|Collection showName(string $label = null)
     * @method Show\Field|Collection symbol(string $label = null)
     * @method Show\Field|Collection vol(string $label = null)
     * @method Show\Field|Collection distribute_id(string $label = null)
     * @method Show\Field|Collection day(string $label = null)
     * @method Show\Field|Collection hash_key(string $label = null)
     * @method Show\Field|Collection info(string $label = null)
     * @method Show\Field|Collection product_id(string $label = null)
     * @method Show\Field|Collection total_amount(string $label = null)
     * @method Show\Field|Collection first(string $label = null)
     * @method Show\Field|Collection formula(string $label = null)
     * @method Show\Field|Collection line_day(string $label = null)
     * @method Show\Field|Collection stage_id(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection base(string $label = null)
     * @method Show\Field|Collection due_date(string $label = null)
     * @method Show\Field|Collection installment_id(string $label = null)
     * @method Show\Field|Collection paid_at(string $label = null)
     * @method Show\Field|Collection pay_prove(string $label = null)
     * @method Show\Field|Collection payment_method(string $label = null)
     * @method Show\Field|Collection refund_status(string $label = null)
     * @method Show\Field|Collection sequence(string $label = null)
     * @method Show\Field|Collection count(string $label = null)
     * @method Show\Field|Collection no(string $label = null)
     * @method Show\Field|Collection attempts(string $label = null)
     * @method Show\Field|Collection available_at(string $label = null)
     * @method Show\Field|Collection reserved_at(string $label = null)
     * @method Show\Field|Collection interest(string $label = null)
     * @method Show\Field|Collection interest_rate(string $label = null)
     * @method Show\Field|Collection loan_id(string $label = null)
     * @method Show\Field|Collection profit_rate(string $label = null)
     * @method Show\Field|Collection to_be_returned(string $label = null)
     * @method Show\Field|Collection already_interest(string $label = null)
     * @method Show\Field|Collection last_dated(string $label = null)
     * @method Show\Field|Collection look_down(string $label = null)
     * @method Show\Field|Collection look_up(string $label = null)
     * @method Show\Field|Collection looks(string $label = null)
     * @method Show\Field|Collection stars(string $label = null)
     * @method Show\Field|Collection closed(string $label = null)
     * @method Show\Field|Collection mortgage(string $label = null)
     * @method Show\Field|Collection paid_prove(string $label = null)
     * @method Show\Field|Collection payment_price(string $label = null)
     * @method Show\Field|Collection profit_data(string $label = null)
     * @method Show\Field|Collection total_powers(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection e_name(string $label = null)
     * @method Show\Field|Collection rate(string $label = null)
     * @method Show\Field|Collection real_info(string $label = null)
     * @method Show\Field|Collection lock(string $label = null)
     * @method Show\Field|Collection num(string $label = null)
     * @method Show\Field|Collection power(string $label = null)
     * @method Show\Field|Collection power_distribute_id(string $label = null)
     * @method Show\Field|Collection unlock(string $label = null)
     * @method Show\Field|Collection available_assets(string $label = null)
     * @method Show\Field|Collection agreement_id(string $label = null)
     * @method Show\Field|Collection attributes(string $label = null)
     * @method Show\Field|Collection begin_at(string $label = null)
     * @method Show\Field|Collection category_id(string $label = null)
     * @method Show\Field|Collection commission(string $label = null)
     * @method Show\Field|Collection end_at(string $label = null)
     * @method Show\Field|Collection installment_data(string $label = null)
     * @method Show\Field|Collection labels(string $label = null)
     * @method Show\Field|Collection on_sale(string $label = null)
     * @method Show\Field|Collection original_price(string $label = null)
     * @method Show\Field|Collection pay_methods(string $label = null)
     * @method Show\Field|Collection price(string $label = null)
     * @method Show\Field|Collection stock(string $label = null)
     * @method Show\Field|Collection currency(string $label = null)
     * @method Show\Field|Collection recharge_prove(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     * @method Show\Field|Collection grade(string $label = null)
     * @method Show\Field|Collection idcard_data(string $label = null)
     * @method Show\Field|Collection invite_id(string $label = null)
     * @method Show\Field|Collection openid(string $label = null)
     * @method Show\Field|Collection safe_password(string $label = null)
     * @method Show\Field|Collection md5file(string $label = null)
     * @method Show\Field|Collection min_version(string $label = null)
     * @method Show\Field|Collection new_version(string $label = null)
     * @method Show\Field|Collection size(string $label = null)
     * @method Show\Field|Collection terminal(string $label = null)
     * @method Show\Field|Collection update_description(string $label = null)
     * @method Show\Field|Collection url(string $label = null)
     * @method Show\Field|Collection frozen_amount(string $label = null)
     * @method Show\Field|Collection withdrawal_amount(string $label = null)
     * @method Show\Field|Collection actual_amount(string $label = null)
     * @method Show\Field|Collection coin_address(string $label = null)
     * @method Show\Field|Collection create_time(string $label = null)
     * @method Show\Field|Collection update_time(string $label = null)
     * @method Show\Field|Collection A(string $label = null)
     * @method Show\Field|Collection A1(string $label = null)
     * @method Show\Field|Collection A2(string $label = null)
     * @method Show\Field|Collection AVP(string $label = null)
     * @method Show\Field|Collection B1(string $label = null)
     * @method Show\Field|Collection B1V(string $label = null)
     * @method Show\Field|Collection B2(string $label = null)
     * @method Show\Field|Collection B2V(string $label = null)
     * @method Show\Field|Collection B3(string $label = null)
     * @method Show\Field|Collection B3V(string $label = null)
     * @method Show\Field|Collection B4(string $label = null)
     * @method Show\Field|Collection B4V(string $label = null)
     * @method Show\Field|Collection B5(string $label = null)
     * @method Show\Field|Collection B5V(string $label = null)
     * @method Show\Field|Collection C(string $label = null)
     * @method Show\Field|Collection DT(string $label = null)
     * @method Show\Field|Collection FS(string $label = null)
     * @method Show\Field|Collection H(string $label = null)
     * @method Show\Field|Collection HD(string $label = null)
     * @method Show\Field|Collection HS(string $label = null)
     * @method Show\Field|Collection IV(string $label = null)
     * @method Show\Field|Collection JS(string $label = null)
     * @method Show\Field|Collection L(string $label = null)
     * @method Show\Field|Collection LS(string $label = null)
     * @method Show\Field|Collection M(string $label = null)
     * @method Show\Field|Collection N(string $label = null)
     * @method Show\Field|Collection N2(string $label = null)
     * @method Show\Field|Collection NV(string $label = null)
     * @method Show\Field|Collection O(string $label = null)
     * @method Show\Field|Collection OV(string $label = null)
     * @method Show\Field|Collection P(string $label = null)
     * @method Show\Field|Collection QJ(string $label = null)
     * @method Show\Field|Collection QR(string $label = null)
     * @method Show\Field|Collection S(string $label = null)
     * @method Show\Field|Collection S1(string $label = null)
     * @method Show\Field|Collection S1V(string $label = null)
     * @method Show\Field|Collection S2(string $label = null)
     * @method Show\Field|Collection S2V(string $label = null)
     * @method Show\Field|Collection S3(string $label = null)
     * @method Show\Field|Collection S3V(string $label = null)
     * @method Show\Field|Collection S4(string $label = null)
     * @method Show\Field|Collection S4V(string $label = null)
     * @method Show\Field|Collection S5(string $label = null)
     * @method Show\Field|Collection S5V(string $label = null)
     * @method Show\Field|Collection SJ(string $label = null)
     * @method Show\Field|Collection SY(string $label = null)
     * @method Show\Field|Collection SY2(string $label = null)
     * @method Show\Field|Collection Tick(string $label = null)
     * @method Show\Field|Collection Time(string $label = null)
     * @method Show\Field|Collection TS(string $label = null)
     * @method Show\Field|Collection V(string $label = null)
     * @method Show\Field|Collection VF(string $label = null)
     * @method Show\Field|Collection YC(string $label = null)
     * @method Show\Field|Collection YDH(string $label = null)
     * @method Show\Field|Collection YHD(string $label = null)
     * @method Show\Field|Collection YJS(string $label = null)
     * @method Show\Field|Collection Z(string $label = null)
     * @method Show\Field|Collection Z2(string $label = null)
     * @method Show\Field|Collection ZD(string $label = null)
     * @method Show\Field|Collection ZF(string $label = null)
     * @method Show\Field|Collection ZS(string $label = null)
     * @method Show\Field|Collection ZT(string $label = null)
     * @method Show\Field|Collection contact(string $label = null)
     * @method Show\Field|Collection ctime(string $label = null)
     * @method Show\Field|Collection userid(string $label = null)
     * @method Show\Field|Collection buy_name(string $label = null)
     * @method Show\Field|Collection buy_userid(string $label = null)
     * @method Show\Field|Collection give_buy_integral(string $label = null)
     * @method Show\Field|Collection give_one_commission(string $label = null)
     * @method Show\Field|Collection give_one_name(string $label = null)
     * @method Show\Field|Collection give_one_userid(string $label = null)
     * @method Show\Field|Collection give_two_commission(string $label = null)
     * @method Show\Field|Collection give_two_name(string $label = null)
     * @method Show\Field|Collection give_two_userid(string $label = null)
     * @method Show\Field|Collection payment(string $label = null)
     * @method Show\Field|Collection suanli(string $label = null)
     * @method Show\Field|Collection auther(string $label = null)
     * @method Show\Field|Collection categroy(string $label = null)
     * @method Show\Field|Collection 
original_price(string $label = null)
     * @method Show\Field|Collection integral(string $label = null)
     * @method Show\Field|Collection main_chart(string $label = null)
     * @method Show\Field|Collection rotation_chart(string $label = null)
     * @method Show\Field|Collection goods_id(string $label = null)
     * @method Show\Field|Collection goods_name(string $label = null)
     * @method Show\Field|Collection logistics_no(string $label = null)
     * @method Show\Field|Collection use_integral(string $label = null)
     * @method Show\Field|Collection msg(string $label = null)
     * @method Show\Field|Collection delete_time(string $label = null)
     * @method Show\Field|Collection cate_id(string $label = null)
     * @method Show\Field|Collection discount_price(string $label = null)
     * @method Show\Field|Collection images(string $label = null)
     * @method Show\Field|Collection logo(string $label = null)
     * @method Show\Field|Collection market_price(string $label = null)
     * @method Show\Field|Collection sales(string $label = null)
     * @method Show\Field|Collection total_stock(string $label = null)
     * @method Show\Field|Collection virtual_sales(string $label = null)
     * @method Show\Field|Collection look(string $label = null)
     * @method Show\Field|Collection thumb_image(string $label = null)
     * @method Show\Field|Collection fall(string $label = null)
     * @method Show\Field|Collection rise(string $label = null)
     * @method Show\Field|Collection star(string $label = null)
     * @method Show\Field|Collection display(string $label = null)
     * @method Show\Field|Collection electric(string $label = null)
     * @method Show\Field|Collection fil_profit(string $label = null)
     * @method Show\Field|Collection get_integral(string $label = null)
     * @method Show\Field|Collection management_expenses(string $label = null)
     * @method Show\Field|Collection open_time(string $label = null)
     * @method Show\Field|Collection physics(string $label = null)
     * @method Show\Field|Collection rate_of_return(string $label = null)
     * @method Show\Field|Collection rmb_profit(string $label = null)
     * @method Show\Field|Collection stage(string $label = null)
     * @method Show\Field|Collection term(string $label = null)
     * @method Show\Field|Collection virtual(string $label = null)
     * @method Show\Field|Collection ftime(string $label = null)
     * @method Show\Field|Collection is_commission(string $label = null)
     * @method Show\Field|Collection pay_mode(string $label = null)
     * @method Show\Field|Collection payevidence_image(string $label = null)
     * @method Show\Field|Collection user_name(string $label = null)
     * @method Show\Field|Collection user_phone(string $label = null)
     * @method Show\Field|Collection auth_ids(string $label = null)
     * @method Show\Field|Collection head_img(string $label = null)
     * @method Show\Field|Collection login_num(string $label = null)
     * @method Show\Field|Collection auth_id(string $label = null)
     * @method Show\Field|Collection node_id(string $label = null)
     * @method Show\Field|Collection group(string $label = null)
     * @method Show\Field|Collection ip(string $label = null)
     * @method Show\Field|Collection method(string $label = null)
     * @method Show\Field|Collection useragent(string $label = null)
     * @method Show\Field|Collection href(string $label = null)
     * @method Show\Field|Collection params(string $label = null)
     * @method Show\Field|Collection pid(string $label = null)
     * @method Show\Field|Collection target(string $label = null)
     * @method Show\Field|Collection is_auth(string $label = null)
     * @method Show\Field|Collection node(string $label = null)
     * @method Show\Field|Collection file_ext(string $label = null)
     * @method Show\Field|Collection file_size(string $label = null)
     * @method Show\Field|Collection image_frames(string $label = null)
     * @method Show\Field|Collection image_height(string $label = null)
     * @method Show\Field|Collection image_type(string $label = null)
     * @method Show\Field|Collection image_width(string $label = null)
     * @method Show\Field|Collection mime_type(string $label = null)
     * @method Show\Field|Collection original_name(string $label = null)
     * @method Show\Field|Collection sha1(string $label = null)
     * @method Show\Field|Collection upload_time(string $label = null)
     * @method Show\Field|Collection upload_type(string $label = null)
     * @method Show\Field|Collection available_commission(string $label = null)
     * @method Show\Field|Collection fil_assets(string $label = null)
     * @method Show\Field|Collection fil_available_assets(string $label = null)
     * @method Show\Field|Collection fil_freezing_assets(string $label = null)
     * @method Show\Field|Collection freezing_commission(string $label = null)
     * @method Show\Field|Collection headimgurl(string $label = null)
     * @method Show\Field|Collection idcard_back_image(string $label = null)
     * @method Show\Field|Collection idcard_front_image(string $label = null)
     * @method Show\Field|Collection pay_password(string $label = null)
     * @method Show\Field|Collection superintendent(string $label = null)
     * @method Show\Field|Collection uptime(string $label = null)
     * @method Show\Field|Collection usdt_assets(string $label = null)
     * @method Show\Field|Collection usdt_available_assets(string $label = null)
     * @method Show\Field|Collection usdt_freezing_assets(string $label = null)
     * @method Show\Field|Collection bankname(string $label = null)
     * @method Show\Field|Collection card(string $label = null)
     * @method Show\Field|Collection extract_type(string $label = null)
     * @method Show\Field|Collection is_payment(string $label = null)
     * @method Show\Field|Collection money(string $label = null)
     * @method Show\Field|Collection payee(string $label = null)
     * @method Show\Field|Collection poundage(string $label = null)
     * @method Show\Field|Collection prove_image(string $label = null)
     * @method Show\Field|Collection idcard_back(string $label = null)
     * @method Show\Field|Collection idcard_front(string $label = null)
     * @method Show\Field|Collection signed_photo(string $label = null)
     * @method Show\Field|Collection cycle(string $label = null)
     * @method Show\Field|Collection first_cycle(string $label = null)
     * @method Show\Field|Collection mode(string $label = null)
     * @method Show\Field|Collection mortgage_advance(string $label = null)
     * @method Show\Field|Collection mortgage_user(string $label = null)
     * @method Show\Field|Collection create_date(string $label = null)
     * @method Show\Field|Collection distributeid(string $label = null)
     * @method Show\Field|Collection assets(string $label = null)
     * @method Show\Field|Collection earnings(string $label = null)
     * @method Show\Field|Collection earnings_lock(string $label = null)
     * @method Show\Field|Collection earnings_unlock(string $label = null)
     * @method Show\Field|Collection freezing_assets(string $label = null)
     * @method Show\Field|Collection suanli2(string $label = null)
     * @method Show\Field|Collection suanli3(string $label = null)
     * @method Show\Field|Collection suanli4(string $label = null)
     * @method Show\Field|Collection suanli5(string $label = null)
     * @method Show\Field|Collection transfer_fil(string $label = null)
     * @method Show\Field|Collection uid(string $label = null)
     * @method Show\Field|Collection is_extract(string $label = null)
     * @method Show\Field|Collection coin(string $label = null)
     * @method Show\Field|Collection is_tranfer(string $label = null)
     * @method Show\Field|Collection begin(string $label = null)
     * @method Show\Field|Collection every_t(string $label = null)
     * @method Show\Field|Collection filecoin(string $label = null)
     * @method Show\Field|Collection release_date(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
