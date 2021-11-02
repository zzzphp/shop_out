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
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection currency_id
     * @property Grid\Column|Collection chain
     * @property Grid\Column|Collection address
     * @property Grid\Column|Collection remark
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection admin_id
     * @property Grid\Column|Collection agent_id
     * @property Grid\Column|Collection users_count
     * @property Grid\Column|Collection orders_count
     * @property Grid\Column|Collection amount
     * @property Grid\Column|Collection payment_type
     * @property Grid\Column|Collection dated
     * @property Grid\Column|Collection phone
     * @property Grid\Column|Collection legal_person
     * @property Grid\Column|Collection idcard
     * @property Grid\Column|Collection image
     * @property Grid\Column|Collection ability
     * @property Grid\Column|Collection sales_ratio
     * @property Grid\Column|Collection admin_parent_id
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection front_amount
     * @property Grid\Column|Collection after_amount
     * @property Grid\Column|Collection sign
     * @property Grid\Column|Collection sort
     * @property Grid\Column|Collection link
     * @property Grid\Column|Collection describe
     * @property Grid\Column|Collection is_show
     * @property Grid\Column|Collection open_time
     * @property Grid\Column|Collection hash_key
     * @property Grid\Column|Collection data
     * @property Grid\Column|Collection order_id
     * @property Grid\Column|Collection level
     * @property Grid\Column|Collection address_data
     * @property Grid\Column|Collection chains
     * @property Grid\Column|Collection min_amount
     * @property Grid\Column|Collection service_charge
     * @property Grid\Column|Collection symbol
     * @property Grid\Column|Collection vol
     * @property Grid\Column|Collection high
     * @property Grid\Column|Collection last
     * @property Grid\Column|Collection low
     * @property Grid\Column|Collection buy
     * @property Grid\Column|Collection sell
     * @property Grid\Column|Collection change
     * @property Grid\Column|Collection rose
     * @property Grid\Column|Collection isShow
     * @property Grid\Column|Collection newCoinFlag
     * @property Grid\Column|Collection showName
     * @property Grid\Column|Collection distribute_id
     * @property Grid\Column|Collection day
     * @property Grid\Column|Collection product_id
     * @property Grid\Column|Collection total_amount
     * @property Grid\Column|Collection info
     * @property Grid\Column|Collection first
     * @property Grid\Column|Collection line_day
     * @property Grid\Column|Collection stage_id
     * @property Grid\Column|Collection formula
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection installment_id
     * @property Grid\Column|Collection sequence
     * @property Grid\Column|Collection base
     * @property Grid\Column|Collection due_date
     * @property Grid\Column|Collection paid_at
     * @property Grid\Column|Collection payment_method
     * @property Grid\Column|Collection refund_status
     * @property Grid\Column|Collection pay_prove
     * @property Grid\Column|Collection no
     * @property Grid\Column|Collection count
     * @property Grid\Column|Collection attempts
     * @property Grid\Column|Collection reserved_at
     * @property Grid\Column|Collection available_at
     * @property Grid\Column|Collection loan_id
     * @property Grid\Column|Collection to_be_returned
     * @property Grid\Column|Collection interest
     * @property Grid\Column|Collection profit_rate
     * @property Grid\Column|Collection interest_rate
     * @property Grid\Column|Collection already_interest
     * @property Grid\Column|Collection last_dated
     * @property Grid\Column|Collection looks
     * @property Grid\Column|Collection stars
     * @property Grid\Column|Collection look_up
     * @property Grid\Column|Collection look_down
     * @property Grid\Column|Collection summary
     * @property Grid\Column|Collection resource_url
     * @property Grid\Column|Collection resource_id
     * @property Grid\Column|Collection author
     * @property Grid\Column|Collection thumbnail
     * @property Grid\Column|Collection payment_price
     * @property Grid\Column|Collection total_powers
     * @property Grid\Column|Collection paid_prove
     * @property Grid\Column|Collection closed
     * @property Grid\Column|Collection profit_data
     * @property Grid\Column|Collection mortgage
     * @property Grid\Column|Collection collection
     * @property Grid\Column|Collection express_data
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection e_name
     * @property Grid\Column|Collection real_info
     * @property Grid\Column|Collection rate
     * @property Grid\Column|Collection power_distribute_id
     * @property Grid\Column|Collection power
     * @property Grid\Column|Collection lock
     * @property Grid\Column|Collection unlock
     * @property Grid\Column|Collection num
     * @property Grid\Column|Collection available_assets
     * @property Grid\Column|Collection origin_order
     * @property Grid\Column|Collection original_price
     * @property Grid\Column|Collection price
     * @property Grid\Column|Collection attributes
     * @property Grid\Column|Collection begin_at
     * @property Grid\Column|Collection end_at
     * @property Grid\Column|Collection stock
     * @property Grid\Column|Collection commission
     * @property Grid\Column|Collection on_sale
     * @property Grid\Column|Collection category_id
     * @property Grid\Column|Collection currency
     * @property Grid\Column|Collection recharge_prove
     * @property Grid\Column|Collection recharge_data
     * @property Grid\Column|Collection logo
     * @property Grid\Column|Collection quota_data
     * @property Grid\Column|Collection province
     * @property Grid\Column|Collection city
     * @property Grid\Column|Collection district
     * @property Grid\Column|Collection zip
     * @property Grid\Column|Collection contact_name
     * @property Grid\Column|Collection contact_phone
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection is_default
     * @property Grid\Column|Collection openid
     * @property Grid\Column|Collection idcard_data
     * @property Grid\Column|Collection email_verified_at
     * @property Grid\Column|Collection safe_password
     * @property Grid\Column|Collection invite_id
     * @property Grid\Column|Collection grade
     * @property Grid\Column|Collection apply_at
     * @property Grid\Column|Collection is_ban
     * @property Grid\Column|Collection share_rate
     * @property Grid\Column|Collection new_version
     * @property Grid\Column|Collection min_version
     * @property Grid\Column|Collection url
     * @property Grid\Column|Collection update_description
     * @property Grid\Column|Collection size
     * @property Grid\Column|Collection md5file
     * @property Grid\Column|Collection terminal
     * @property Grid\Column|Collection frozen_amount
     * @property Grid\Column|Collection withdrawal_amount
     * @property Grid\Column|Collection bond
     * @property Grid\Column|Collection integral
     * @property Grid\Column|Collection coin_address
     * @property Grid\Column|Collection actual_amount
     *
     * @method Grid\Column|Collection post(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection currency_id(string $label = null)
     * @method Grid\Column|Collection chain(string $label = null)
     * @method Grid\Column|Collection address(string $label = null)
     * @method Grid\Column|Collection remark(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection admin_id(string $label = null)
     * @method Grid\Column|Collection agent_id(string $label = null)
     * @method Grid\Column|Collection users_count(string $label = null)
     * @method Grid\Column|Collection orders_count(string $label = null)
     * @method Grid\Column|Collection amount(string $label = null)
     * @method Grid\Column|Collection payment_type(string $label = null)
     * @method Grid\Column|Collection dated(string $label = null)
     * @method Grid\Column|Collection phone(string $label = null)
     * @method Grid\Column|Collection legal_person(string $label = null)
     * @method Grid\Column|Collection idcard(string $label = null)
     * @method Grid\Column|Collection image(string $label = null)
     * @method Grid\Column|Collection ability(string $label = null)
     * @method Grid\Column|Collection sales_ratio(string $label = null)
     * @method Grid\Column|Collection admin_parent_id(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection front_amount(string $label = null)
     * @method Grid\Column|Collection after_amount(string $label = null)
     * @method Grid\Column|Collection sign(string $label = null)
     * @method Grid\Column|Collection sort(string $label = null)
     * @method Grid\Column|Collection link(string $label = null)
     * @method Grid\Column|Collection describe(string $label = null)
     * @method Grid\Column|Collection is_show(string $label = null)
     * @method Grid\Column|Collection open_time(string $label = null)
     * @method Grid\Column|Collection hash_key(string $label = null)
     * @method Grid\Column|Collection data(string $label = null)
     * @method Grid\Column|Collection order_id(string $label = null)
     * @method Grid\Column|Collection level(string $label = null)
     * @method Grid\Column|Collection address_data(string $label = null)
     * @method Grid\Column|Collection chains(string $label = null)
     * @method Grid\Column|Collection min_amount(string $label = null)
     * @method Grid\Column|Collection service_charge(string $label = null)
     * @method Grid\Column|Collection symbol(string $label = null)
     * @method Grid\Column|Collection vol(string $label = null)
     * @method Grid\Column|Collection high(string $label = null)
     * @method Grid\Column|Collection last(string $label = null)
     * @method Grid\Column|Collection low(string $label = null)
     * @method Grid\Column|Collection buy(string $label = null)
     * @method Grid\Column|Collection sell(string $label = null)
     * @method Grid\Column|Collection change(string $label = null)
     * @method Grid\Column|Collection rose(string $label = null)
     * @method Grid\Column|Collection isShow(string $label = null)
     * @method Grid\Column|Collection newCoinFlag(string $label = null)
     * @method Grid\Column|Collection showName(string $label = null)
     * @method Grid\Column|Collection distribute_id(string $label = null)
     * @method Grid\Column|Collection day(string $label = null)
     * @method Grid\Column|Collection product_id(string $label = null)
     * @method Grid\Column|Collection total_amount(string $label = null)
     * @method Grid\Column|Collection info(string $label = null)
     * @method Grid\Column|Collection first(string $label = null)
     * @method Grid\Column|Collection line_day(string $label = null)
     * @method Grid\Column|Collection stage_id(string $label = null)
     * @method Grid\Column|Collection formula(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection installment_id(string $label = null)
     * @method Grid\Column|Collection sequence(string $label = null)
     * @method Grid\Column|Collection base(string $label = null)
     * @method Grid\Column|Collection due_date(string $label = null)
     * @method Grid\Column|Collection paid_at(string $label = null)
     * @method Grid\Column|Collection payment_method(string $label = null)
     * @method Grid\Column|Collection refund_status(string $label = null)
     * @method Grid\Column|Collection pay_prove(string $label = null)
     * @method Grid\Column|Collection no(string $label = null)
     * @method Grid\Column|Collection count(string $label = null)
     * @method Grid\Column|Collection attempts(string $label = null)
     * @method Grid\Column|Collection reserved_at(string $label = null)
     * @method Grid\Column|Collection available_at(string $label = null)
     * @method Grid\Column|Collection loan_id(string $label = null)
     * @method Grid\Column|Collection to_be_returned(string $label = null)
     * @method Grid\Column|Collection interest(string $label = null)
     * @method Grid\Column|Collection profit_rate(string $label = null)
     * @method Grid\Column|Collection interest_rate(string $label = null)
     * @method Grid\Column|Collection already_interest(string $label = null)
     * @method Grid\Column|Collection last_dated(string $label = null)
     * @method Grid\Column|Collection looks(string $label = null)
     * @method Grid\Column|Collection stars(string $label = null)
     * @method Grid\Column|Collection look_up(string $label = null)
     * @method Grid\Column|Collection look_down(string $label = null)
     * @method Grid\Column|Collection summary(string $label = null)
     * @method Grid\Column|Collection resource_url(string $label = null)
     * @method Grid\Column|Collection resource_id(string $label = null)
     * @method Grid\Column|Collection author(string $label = null)
     * @method Grid\Column|Collection thumbnail(string $label = null)
     * @method Grid\Column|Collection payment_price(string $label = null)
     * @method Grid\Column|Collection total_powers(string $label = null)
     * @method Grid\Column|Collection paid_prove(string $label = null)
     * @method Grid\Column|Collection closed(string $label = null)
     * @method Grid\Column|Collection profit_data(string $label = null)
     * @method Grid\Column|Collection mortgage(string $label = null)
     * @method Grid\Column|Collection collection(string $label = null)
     * @method Grid\Column|Collection express_data(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection e_name(string $label = null)
     * @method Grid\Column|Collection real_info(string $label = null)
     * @method Grid\Column|Collection rate(string $label = null)
     * @method Grid\Column|Collection power_distribute_id(string $label = null)
     * @method Grid\Column|Collection power(string $label = null)
     * @method Grid\Column|Collection lock(string $label = null)
     * @method Grid\Column|Collection unlock(string $label = null)
     * @method Grid\Column|Collection num(string $label = null)
     * @method Grid\Column|Collection available_assets(string $label = null)
     * @method Grid\Column|Collection origin_order(string $label = null)
     * @method Grid\Column|Collection original_price(string $label = null)
     * @method Grid\Column|Collection price(string $label = null)
     * @method Grid\Column|Collection attributes(string $label = null)
     * @method Grid\Column|Collection begin_at(string $label = null)
     * @method Grid\Column|Collection end_at(string $label = null)
     * @method Grid\Column|Collection stock(string $label = null)
     * @method Grid\Column|Collection commission(string $label = null)
     * @method Grid\Column|Collection on_sale(string $label = null)
     * @method Grid\Column|Collection category_id(string $label = null)
     * @method Grid\Column|Collection currency(string $label = null)
     * @method Grid\Column|Collection recharge_prove(string $label = null)
     * @method Grid\Column|Collection recharge_data(string $label = null)
     * @method Grid\Column|Collection logo(string $label = null)
     * @method Grid\Column|Collection quota_data(string $label = null)
     * @method Grid\Column|Collection province(string $label = null)
     * @method Grid\Column|Collection city(string $label = null)
     * @method Grid\Column|Collection district(string $label = null)
     * @method Grid\Column|Collection zip(string $label = null)
     * @method Grid\Column|Collection contact_name(string $label = null)
     * @method Grid\Column|Collection contact_phone(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection is_default(string $label = null)
     * @method Grid\Column|Collection openid(string $label = null)
     * @method Grid\Column|Collection idcard_data(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     * @method Grid\Column|Collection safe_password(string $label = null)
     * @method Grid\Column|Collection invite_id(string $label = null)
     * @method Grid\Column|Collection grade(string $label = null)
     * @method Grid\Column|Collection apply_at(string $label = null)
     * @method Grid\Column|Collection is_ban(string $label = null)
     * @method Grid\Column|Collection share_rate(string $label = null)
     * @method Grid\Column|Collection new_version(string $label = null)
     * @method Grid\Column|Collection min_version(string $label = null)
     * @method Grid\Column|Collection url(string $label = null)
     * @method Grid\Column|Collection update_description(string $label = null)
     * @method Grid\Column|Collection size(string $label = null)
     * @method Grid\Column|Collection md5file(string $label = null)
     * @method Grid\Column|Collection terminal(string $label = null)
     * @method Grid\Column|Collection frozen_amount(string $label = null)
     * @method Grid\Column|Collection withdrawal_amount(string $label = null)
     * @method Grid\Column|Collection bond(string $label = null)
     * @method Grid\Column|Collection integral(string $label = null)
     * @method Grid\Column|Collection coin_address(string $label = null)
     * @method Grid\Column|Collection actual_amount(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection post
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection currency_id
     * @property Show\Field|Collection chain
     * @property Show\Field|Collection address
     * @property Show\Field|Collection remark
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection version
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection order
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection username
     * @property Show\Field|Collection password
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection admin_id
     * @property Show\Field|Collection agent_id
     * @property Show\Field|Collection users_count
     * @property Show\Field|Collection orders_count
     * @property Show\Field|Collection amount
     * @property Show\Field|Collection payment_type
     * @property Show\Field|Collection dated
     * @property Show\Field|Collection phone
     * @property Show\Field|Collection legal_person
     * @property Show\Field|Collection idcard
     * @property Show\Field|Collection image
     * @property Show\Field|Collection ability
     * @property Show\Field|Collection sales_ratio
     * @property Show\Field|Collection admin_parent_id
     * @property Show\Field|Collection content
     * @property Show\Field|Collection status
     * @property Show\Field|Collection front_amount
     * @property Show\Field|Collection after_amount
     * @property Show\Field|Collection sign
     * @property Show\Field|Collection sort
     * @property Show\Field|Collection link
     * @property Show\Field|Collection describe
     * @property Show\Field|Collection is_show
     * @property Show\Field|Collection open_time
     * @property Show\Field|Collection hash_key
     * @property Show\Field|Collection data
     * @property Show\Field|Collection order_id
     * @property Show\Field|Collection level
     * @property Show\Field|Collection address_data
     * @property Show\Field|Collection chains
     * @property Show\Field|Collection min_amount
     * @property Show\Field|Collection service_charge
     * @property Show\Field|Collection symbol
     * @property Show\Field|Collection vol
     * @property Show\Field|Collection high
     * @property Show\Field|Collection last
     * @property Show\Field|Collection low
     * @property Show\Field|Collection buy
     * @property Show\Field|Collection sell
     * @property Show\Field|Collection change
     * @property Show\Field|Collection rose
     * @property Show\Field|Collection isShow
     * @property Show\Field|Collection newCoinFlag
     * @property Show\Field|Collection showName
     * @property Show\Field|Collection distribute_id
     * @property Show\Field|Collection day
     * @property Show\Field|Collection product_id
     * @property Show\Field|Collection total_amount
     * @property Show\Field|Collection info
     * @property Show\Field|Collection first
     * @property Show\Field|Collection line_day
     * @property Show\Field|Collection stage_id
     * @property Show\Field|Collection formula
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection installment_id
     * @property Show\Field|Collection sequence
     * @property Show\Field|Collection base
     * @property Show\Field|Collection due_date
     * @property Show\Field|Collection paid_at
     * @property Show\Field|Collection payment_method
     * @property Show\Field|Collection refund_status
     * @property Show\Field|Collection pay_prove
     * @property Show\Field|Collection no
     * @property Show\Field|Collection count
     * @property Show\Field|Collection attempts
     * @property Show\Field|Collection reserved_at
     * @property Show\Field|Collection available_at
     * @property Show\Field|Collection loan_id
     * @property Show\Field|Collection to_be_returned
     * @property Show\Field|Collection interest
     * @property Show\Field|Collection profit_rate
     * @property Show\Field|Collection interest_rate
     * @property Show\Field|Collection already_interest
     * @property Show\Field|Collection last_dated
     * @property Show\Field|Collection looks
     * @property Show\Field|Collection stars
     * @property Show\Field|Collection look_up
     * @property Show\Field|Collection look_down
     * @property Show\Field|Collection summary
     * @property Show\Field|Collection resource_url
     * @property Show\Field|Collection resource_id
     * @property Show\Field|Collection author
     * @property Show\Field|Collection thumbnail
     * @property Show\Field|Collection payment_price
     * @property Show\Field|Collection total_powers
     * @property Show\Field|Collection paid_prove
     * @property Show\Field|Collection closed
     * @property Show\Field|Collection profit_data
     * @property Show\Field|Collection mortgage
     * @property Show\Field|Collection collection
     * @property Show\Field|Collection express_data
     * @property Show\Field|Collection email
     * @property Show\Field|Collection token
     * @property Show\Field|Collection e_name
     * @property Show\Field|Collection real_info
     * @property Show\Field|Collection rate
     * @property Show\Field|Collection power_distribute_id
     * @property Show\Field|Collection power
     * @property Show\Field|Collection lock
     * @property Show\Field|Collection unlock
     * @property Show\Field|Collection num
     * @property Show\Field|Collection available_assets
     * @property Show\Field|Collection origin_order
     * @property Show\Field|Collection original_price
     * @property Show\Field|Collection price
     * @property Show\Field|Collection attributes
     * @property Show\Field|Collection begin_at
     * @property Show\Field|Collection end_at
     * @property Show\Field|Collection stock
     * @property Show\Field|Collection commission
     * @property Show\Field|Collection on_sale
     * @property Show\Field|Collection category_id
     * @property Show\Field|Collection currency
     * @property Show\Field|Collection recharge_prove
     * @property Show\Field|Collection recharge_data
     * @property Show\Field|Collection logo
     * @property Show\Field|Collection quota_data
     * @property Show\Field|Collection province
     * @property Show\Field|Collection city
     * @property Show\Field|Collection district
     * @property Show\Field|Collection zip
     * @property Show\Field|Collection contact_name
     * @property Show\Field|Collection contact_phone
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection is_default
     * @property Show\Field|Collection openid
     * @property Show\Field|Collection idcard_data
     * @property Show\Field|Collection email_verified_at
     * @property Show\Field|Collection safe_password
     * @property Show\Field|Collection invite_id
     * @property Show\Field|Collection grade
     * @property Show\Field|Collection apply_at
     * @property Show\Field|Collection is_ban
     * @property Show\Field|Collection share_rate
     * @property Show\Field|Collection new_version
     * @property Show\Field|Collection min_version
     * @property Show\Field|Collection url
     * @property Show\Field|Collection update_description
     * @property Show\Field|Collection size
     * @property Show\Field|Collection md5file
     * @property Show\Field|Collection terminal
     * @property Show\Field|Collection frozen_amount
     * @property Show\Field|Collection withdrawal_amount
     * @property Show\Field|Collection bond
     * @property Show\Field|Collection integral
     * @property Show\Field|Collection coin_address
     * @property Show\Field|Collection actual_amount
     *
     * @method Show\Field|Collection post(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection currency_id(string $label = null)
     * @method Show\Field|Collection chain(string $label = null)
     * @method Show\Field|Collection address(string $label = null)
     * @method Show\Field|Collection remark(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection admin_id(string $label = null)
     * @method Show\Field|Collection agent_id(string $label = null)
     * @method Show\Field|Collection users_count(string $label = null)
     * @method Show\Field|Collection orders_count(string $label = null)
     * @method Show\Field|Collection amount(string $label = null)
     * @method Show\Field|Collection payment_type(string $label = null)
     * @method Show\Field|Collection dated(string $label = null)
     * @method Show\Field|Collection phone(string $label = null)
     * @method Show\Field|Collection legal_person(string $label = null)
     * @method Show\Field|Collection idcard(string $label = null)
     * @method Show\Field|Collection image(string $label = null)
     * @method Show\Field|Collection ability(string $label = null)
     * @method Show\Field|Collection sales_ratio(string $label = null)
     * @method Show\Field|Collection admin_parent_id(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection front_amount(string $label = null)
     * @method Show\Field|Collection after_amount(string $label = null)
     * @method Show\Field|Collection sign(string $label = null)
     * @method Show\Field|Collection sort(string $label = null)
     * @method Show\Field|Collection link(string $label = null)
     * @method Show\Field|Collection describe(string $label = null)
     * @method Show\Field|Collection is_show(string $label = null)
     * @method Show\Field|Collection open_time(string $label = null)
     * @method Show\Field|Collection hash_key(string $label = null)
     * @method Show\Field|Collection data(string $label = null)
     * @method Show\Field|Collection order_id(string $label = null)
     * @method Show\Field|Collection level(string $label = null)
     * @method Show\Field|Collection address_data(string $label = null)
     * @method Show\Field|Collection chains(string $label = null)
     * @method Show\Field|Collection min_amount(string $label = null)
     * @method Show\Field|Collection service_charge(string $label = null)
     * @method Show\Field|Collection symbol(string $label = null)
     * @method Show\Field|Collection vol(string $label = null)
     * @method Show\Field|Collection high(string $label = null)
     * @method Show\Field|Collection last(string $label = null)
     * @method Show\Field|Collection low(string $label = null)
     * @method Show\Field|Collection buy(string $label = null)
     * @method Show\Field|Collection sell(string $label = null)
     * @method Show\Field|Collection change(string $label = null)
     * @method Show\Field|Collection rose(string $label = null)
     * @method Show\Field|Collection isShow(string $label = null)
     * @method Show\Field|Collection newCoinFlag(string $label = null)
     * @method Show\Field|Collection showName(string $label = null)
     * @method Show\Field|Collection distribute_id(string $label = null)
     * @method Show\Field|Collection day(string $label = null)
     * @method Show\Field|Collection product_id(string $label = null)
     * @method Show\Field|Collection total_amount(string $label = null)
     * @method Show\Field|Collection info(string $label = null)
     * @method Show\Field|Collection first(string $label = null)
     * @method Show\Field|Collection line_day(string $label = null)
     * @method Show\Field|Collection stage_id(string $label = null)
     * @method Show\Field|Collection formula(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection installment_id(string $label = null)
     * @method Show\Field|Collection sequence(string $label = null)
     * @method Show\Field|Collection base(string $label = null)
     * @method Show\Field|Collection due_date(string $label = null)
     * @method Show\Field|Collection paid_at(string $label = null)
     * @method Show\Field|Collection payment_method(string $label = null)
     * @method Show\Field|Collection refund_status(string $label = null)
     * @method Show\Field|Collection pay_prove(string $label = null)
     * @method Show\Field|Collection no(string $label = null)
     * @method Show\Field|Collection count(string $label = null)
     * @method Show\Field|Collection attempts(string $label = null)
     * @method Show\Field|Collection reserved_at(string $label = null)
     * @method Show\Field|Collection available_at(string $label = null)
     * @method Show\Field|Collection loan_id(string $label = null)
     * @method Show\Field|Collection to_be_returned(string $label = null)
     * @method Show\Field|Collection interest(string $label = null)
     * @method Show\Field|Collection profit_rate(string $label = null)
     * @method Show\Field|Collection interest_rate(string $label = null)
     * @method Show\Field|Collection already_interest(string $label = null)
     * @method Show\Field|Collection last_dated(string $label = null)
     * @method Show\Field|Collection looks(string $label = null)
     * @method Show\Field|Collection stars(string $label = null)
     * @method Show\Field|Collection look_up(string $label = null)
     * @method Show\Field|Collection look_down(string $label = null)
     * @method Show\Field|Collection summary(string $label = null)
     * @method Show\Field|Collection resource_url(string $label = null)
     * @method Show\Field|Collection resource_id(string $label = null)
     * @method Show\Field|Collection author(string $label = null)
     * @method Show\Field|Collection thumbnail(string $label = null)
     * @method Show\Field|Collection payment_price(string $label = null)
     * @method Show\Field|Collection total_powers(string $label = null)
     * @method Show\Field|Collection paid_prove(string $label = null)
     * @method Show\Field|Collection closed(string $label = null)
     * @method Show\Field|Collection profit_data(string $label = null)
     * @method Show\Field|Collection mortgage(string $label = null)
     * @method Show\Field|Collection collection(string $label = null)
     * @method Show\Field|Collection express_data(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection e_name(string $label = null)
     * @method Show\Field|Collection real_info(string $label = null)
     * @method Show\Field|Collection rate(string $label = null)
     * @method Show\Field|Collection power_distribute_id(string $label = null)
     * @method Show\Field|Collection power(string $label = null)
     * @method Show\Field|Collection lock(string $label = null)
     * @method Show\Field|Collection unlock(string $label = null)
     * @method Show\Field|Collection num(string $label = null)
     * @method Show\Field|Collection available_assets(string $label = null)
     * @method Show\Field|Collection origin_order(string $label = null)
     * @method Show\Field|Collection original_price(string $label = null)
     * @method Show\Field|Collection price(string $label = null)
     * @method Show\Field|Collection attributes(string $label = null)
     * @method Show\Field|Collection begin_at(string $label = null)
     * @method Show\Field|Collection end_at(string $label = null)
     * @method Show\Field|Collection stock(string $label = null)
     * @method Show\Field|Collection commission(string $label = null)
     * @method Show\Field|Collection on_sale(string $label = null)
     * @method Show\Field|Collection category_id(string $label = null)
     * @method Show\Field|Collection currency(string $label = null)
     * @method Show\Field|Collection recharge_prove(string $label = null)
     * @method Show\Field|Collection recharge_data(string $label = null)
     * @method Show\Field|Collection logo(string $label = null)
     * @method Show\Field|Collection quota_data(string $label = null)
     * @method Show\Field|Collection province(string $label = null)
     * @method Show\Field|Collection city(string $label = null)
     * @method Show\Field|Collection district(string $label = null)
     * @method Show\Field|Collection zip(string $label = null)
     * @method Show\Field|Collection contact_name(string $label = null)
     * @method Show\Field|Collection contact_phone(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection is_default(string $label = null)
     * @method Show\Field|Collection openid(string $label = null)
     * @method Show\Field|Collection idcard_data(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     * @method Show\Field|Collection safe_password(string $label = null)
     * @method Show\Field|Collection invite_id(string $label = null)
     * @method Show\Field|Collection grade(string $label = null)
     * @method Show\Field|Collection apply_at(string $label = null)
     * @method Show\Field|Collection is_ban(string $label = null)
     * @method Show\Field|Collection share_rate(string $label = null)
     * @method Show\Field|Collection new_version(string $label = null)
     * @method Show\Field|Collection min_version(string $label = null)
     * @method Show\Field|Collection url(string $label = null)
     * @method Show\Field|Collection update_description(string $label = null)
     * @method Show\Field|Collection size(string $label = null)
     * @method Show\Field|Collection md5file(string $label = null)
     * @method Show\Field|Collection terminal(string $label = null)
     * @method Show\Field|Collection frozen_amount(string $label = null)
     * @method Show\Field|Collection withdrawal_amount(string $label = null)
     * @method Show\Field|Collection bond(string $label = null)
     * @method Show\Field|Collection integral(string $label = null)
     * @method Show\Field|Collection coin_address(string $label = null)
     * @method Show\Field|Collection actual_amount(string $label = null)
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
