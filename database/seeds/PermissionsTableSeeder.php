<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'complaint_create',
            ],
            [
                'id'    => 18,
                'title' => 'complaint_edit',
            ],
            [
                'id'    => 19,
                'title' => 'complaint_show',
            ],
            [
                'id'    => 20,
                'title' => 'complaint_delete',
            ],
            [
                'id'    => 21,
                'title' => 'complaint_access',
            ],
            [
                'id'    => 22,
                'title' => 'storage_option_create',
            ],
            [
                'id'    => 23,
                'title' => 'storage_option_edit',
            ],
            [
                'id'    => 24,
                'title' => 'storage_option_show',
            ],
            [
                'id'    => 25,
                'title' => 'storage_option_delete',
            ],
            [
                'id'    => 26,
                'title' => 'storage_option_access',
            ],
            [
                'id'    => 27,
                'title' => 'product_collection_create',
            ],
            [
                'id'    => 28,
                'title' => 'product_collection_edit',
            ],
            [
                'id'    => 29,
                'title' => 'product_collection_show',
            ],
            [
                'id'    => 30,
                'title' => 'product_collection_delete',
            ],
            [
                'id'    => 31,
                'title' => 'product_collection_access',
            ],
            [
                'id'    => 32,
                'title' => 'gas_lift_config_create',
            ],
            [
                'id'    => 33,
                'title' => 'gas_lift_config_edit',
            ],
            [
                'id'    => 34,
                'title' => 'gas_lift_config_show',
            ],
            [
                'id'    => 35,
                'title' => 'gas_lift_config_delete',
            ],
            [
                'id'    => 36,
                'title' => 'gas_lift_config_access',
            ],
            [
                'id'    => 37,
                'title' => 'tv_bed_config_create',
            ],
            [
                'id'    => 38,
                'title' => 'tv_bed_config_edit',
            ],
            [
                'id'    => 39,
                'title' => 'tv_bed_config_show',
            ],
            [
                'id'    => 40,
                'title' => 'tv_bed_config_delete',
            ],
            [
                'id'    => 41,
                'title' => 'tv_bed_config_access',
            ],
            [
                'id'    => 42,
                'title' => 'drawer_config_create',
            ],
            [
                'id'    => 43,
                'title' => 'drawer_config_edit',
            ],
            [
                'id'    => 44,
                'title' => 'drawer_config_show',
            ],
            [
                'id'    => 45,
                'title' => 'drawer_config_delete',
            ],
            [
                'id'    => 46,
                'title' => 'drawer_config_access',
            ],
            [
                'id'    => 47,
                'title' => 'visitor_bed_config_create',
            ],
            [
                'id'    => 48,
                'title' => 'visitor_bed_config_edit',
            ],
            [
                'id'    => 49,
                'title' => 'visitor_bed_config_show',
            ],
            [
                'id'    => 50,
                'title' => 'visitor_bed_config_delete',
            ],
            [
                'id'    => 51,
                'title' => 'visitor_bed_config_access',
            ],
            [
                'id'    => 52,
                'title' => 'staff_level_create',
            ],
            [
                'id'    => 53,
                'title' => 'staff_level_edit',
            ],
            [
                'id'    => 54,
                'title' => 'staff_level_show',
            ],
            [
                'id'    => 55,
                'title' => 'staff_level_delete',
            ],
            [
                'id'    => 56,
                'title' => 'staff_level_access',
            ],
            [
                'id'    => 57,
                'title' => 'user_type_create',
            ],
            [
                'id'    => 58,
                'title' => 'user_type_edit',
            ],
            [
                'id'    => 59,
                'title' => 'user_type_show',
            ],
            [
                'id'    => 60,
                'title' => 'user_type_delete',
            ],
            [
                'id'    => 61,
                'title' => 'user_type_access',
            ],
            [
                'id'    => 62,
                'title' => 'raw_material_type_create',
            ],
            [
                'id'    => 63,
                'title' => 'raw_material_type_edit',
            ],
            [
                'id'    => 64,
                'title' => 'raw_material_type_show',
            ],
            [
                'id'    => 65,
                'title' => 'raw_material_type_delete',
            ],
            [
                'id'    => 66,
                'title' => 'raw_material_type_access',
            ],
            [
                'id'    => 67,
                'title' => 'yes_no_maybe_create',
            ],
            [
                'id'    => 68,
                'title' => 'yes_no_maybe_edit',
            ],
            [
                'id'    => 69,
                'title' => 'yes_no_maybe_show',
            ],
            [
                'id'    => 70,
                'title' => 'yes_no_maybe_delete',
            ],
            [
                'id'    => 71,
                'title' => 'yes_no_maybe_access',
            ],
            [
                'id'    => 72,
                'title' => 'material_finish_create',
            ],
            [
                'id'    => 73,
                'title' => 'material_finish_edit',
            ],
            [
                'id'    => 74,
                'title' => 'material_finish_show',
            ],
            [
                'id'    => 75,
                'title' => 'material_finish_delete',
            ],
            [
                'id'    => 76,
                'title' => 'material_finish_access',
            ],
            [
                'id'    => 77,
                'title' => 'country_create',
            ],
            [
                'id'    => 78,
                'title' => 'country_edit',
            ],
            [
                'id'    => 79,
                'title' => 'country_show',
            ],
            [
                'id'    => 80,
                'title' => 'country_delete',
            ],
            [
                'id'    => 81,
                'title' => 'country_access',
            ],
            [
                'id'    => 82,
                'title' => 'world_region_create',
            ],
            [
                'id'    => 83,
                'title' => 'world_region_edit',
            ],
            [
                'id'    => 84,
                'title' => 'world_region_show',
            ],
            [
                'id'    => 85,
                'title' => 'world_region_delete',
            ],
            [
                'id'    => 86,
                'title' => 'world_region_access',
            ],
            [
                'id'    => 87,
                'title' => 'currency_create',
            ],
            [
                'id'    => 88,
                'title' => 'currency_edit',
            ],
            [
                'id'    => 89,
                'title' => 'currency_show',
            ],
            [
                'id'    => 90,
                'title' => 'currency_delete',
            ],
            [
                'id'    => 91,
                'title' => 'currency_access',
            ],
            [
                'id'    => 92,
                'title' => 'language_create',
            ],
            [
                'id'    => 93,
                'title' => 'language_edit',
            ],
            [
                'id'    => 94,
                'title' => 'language_show',
            ],
            [
                'id'    => 95,
                'title' => 'language_delete',
            ],
            [
                'id'    => 96,
                'title' => 'language_access',
            ],
            [
                'id'    => 97,
                'title' => 'currency_rate_create',
            ],
            [
                'id'    => 98,
                'title' => 'currency_rate_edit',
            ],
            [
                'id'    => 99,
                'title' => 'currency_rate_show',
            ],
            [
                'id'    => 100,
                'title' => 'currency_rate_delete',
            ],
            [
                'id'    => 101,
                'title' => 'currency_rate_access',
            ],
            [
                'id'    => 102,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 103,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 104,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 105,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 106,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 107,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 108,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 109,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 110,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 111,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 112,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 113,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 114,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 115,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 116,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 117,
                'title' => 'expense_create',
            ],
            [
                'id'    => 118,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 119,
                'title' => 'expense_show',
            ],
            [
                'id'    => 120,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 121,
                'title' => 'expense_access',
            ],
            [
                'id'    => 122,
                'title' => 'income_create',
            ],
            [
                'id'    => 123,
                'title' => 'income_edit',
            ],
            [
                'id'    => 124,
                'title' => 'income_show',
            ],
            [
                'id'    => 125,
                'title' => 'income_delete',
            ],
            [
                'id'    => 126,
                'title' => 'income_access',
            ],
            [
                'id'    => 127,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 128,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 129,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 130,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 131,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 132,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 133,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 134,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 135,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 136,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 137,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 138,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 139,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 140,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 141,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 142,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 143,
                'title' => 'setting_access',
            ],
            [
                'id'    => 144,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 145,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 146,
                'title' => 'contact_management_access',
            ],
            [
                'id'    => 147,
                'title' => 'contact_company_create',
            ],
            [
                'id'    => 148,
                'title' => 'contact_company_edit',
            ],
            [
                'id'    => 149,
                'title' => 'contact_company_show',
            ],
            [
                'id'    => 150,
                'title' => 'contact_company_delete',
            ],
            [
                'id'    => 151,
                'title' => 'contact_company_access',
            ],
            [
                'id'    => 152,
                'title' => 'contact_contact_create',
            ],
            [
                'id'    => 153,
                'title' => 'contact_contact_edit',
            ],
            [
                'id'    => 154,
                'title' => 'contact_contact_show',
            ],
            [
                'id'    => 155,
                'title' => 'contact_contact_delete',
            ],
            [
                'id'    => 156,
                'title' => 'contact_contact_access',
            ],
            [
                'id'    => 157,
                'title' => 'company_type_create',
            ],
            [
                'id'    => 158,
                'title' => 'company_type_edit',
            ],
            [
                'id'    => 159,
                'title' => 'company_type_show',
            ],
            [
                'id'    => 160,
                'title' => 'company_type_delete',
            ],
            [
                'id'    => 161,
                'title' => 'company_type_access',
            ],
            [
                'id'    => 162,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 163,
                'title' => 'product_config_access',
            ],
            [
                'id'    => 164,
                'title' => 'expense_config_access',
            ],
            [
                'id'    => 165,
                'title' => 'complaints_management_access',
            ],
            [
                'id'    => 166,
                'title' => 'product_create',
            ],
            [
                'id'    => 167,
                'title' => 'product_edit',
            ],
            [
                'id'    => 168,
                'title' => 'product_show',
            ],
            [
                'id'    => 169,
                'title' => 'product_delete',
            ],
            [
                'id'    => 170,
                'title' => 'product_access',
            ],
            [
                'id'    => 171,
                'title' => 'raw_material_create',
            ],
            [
                'id'    => 172,
                'title' => 'raw_material_edit',
            ],
            [
                'id'    => 173,
                'title' => 'raw_material_show',
            ],
            [
                'id'    => 174,
                'title' => 'raw_material_delete',
            ],
            [
                'id'    => 175,
                'title' => 'raw_material_access',
            ],
            [
                'id'    => 176,
                'title' => 'cff_colour_fabric_finish_access',
            ],
            [
                'id'    => 177,
                'title' => 'product_nickname_create',
            ],
            [
                'id'    => 178,
                'title' => 'product_nickname_edit',
            ],
            [
                'id'    => 179,
                'title' => 'product_nickname_show',
            ],
            [
                'id'    => 180,
                'title' => 'product_nickname_delete',
            ],
            [
                'id'    => 181,
                'title' => 'product_nickname_access',
            ],
            [
                'id'    => 182,
                'title' => 'company_ownership_type_create',
            ],
            [
                'id'    => 183,
                'title' => 'company_ownership_type_edit',
            ],
            [
                'id'    => 184,
                'title' => 'company_ownership_type_show',
            ],
            [
                'id'    => 185,
                'title' => 'company_ownership_type_delete',
            ],
            [
                'id'    => 186,
                'title' => 'company_ownership_type_access',
            ],
            [
                'id'    => 187,
                'title' => 'order_management_access',
            ],
            [
                'id'    => 188,
                'title' => 'order_create',
            ],
            [
                'id'    => 189,
                'title' => 'order_edit',
            ],
            [
                'id'    => 190,
                'title' => 'order_show',
            ],
            [
                'id'    => 191,
                'title' => 'order_delete',
            ],
            [
                'id'    => 192,
                'title' => 'order_access',
            ],
            [
                'id'    => 193,
                'title' => 'address_create',
            ],
            [
                'id'    => 194,
                'title' => 'address_edit',
            ],
            [
                'id'    => 195,
                'title' => 'address_show',
            ],
            [
                'id'    => 196,
                'title' => 'address_delete',
            ],
            [
                'id'    => 197,
                'title' => 'address_access',
            ],
            [
                'id'    => 198,
                'title' => 'province_create',
            ],
            [
                'id'    => 199,
                'title' => 'province_edit',
            ],
            [
                'id'    => 200,
                'title' => 'province_show',
            ],
            [
                'id'    => 201,
                'title' => 'province_delete',
            ],
            [
                'id'    => 202,
                'title' => 'province_access',
            ],
            [
                'id'    => 203,
                'title' => 'afa_staff_create',
            ],
            [
                'id'    => 204,
                'title' => 'afa_staff_edit',
            ],
            [
                'id'    => 205,
                'title' => 'afa_staff_show',
            ],
            [
                'id'    => 206,
                'title' => 'afa_staff_delete',
            ],
            [
                'id'    => 207,
                'title' => 'afa_staff_access',
            ],
            [
                'id'    => 208,
                'title' => 'user_config_access',
            ],
            [
                'id'    => 209,
                'title' => 'contacts_config_access',
            ],
            [
                'id'    => 210,
                'title' => 'product_sku_create',
            ],
            [
                'id'    => 211,
                'title' => 'product_sku_edit',
            ],
            [
                'id'    => 212,
                'title' => 'product_sku_show',
            ],
            [
                'id'    => 213,
                'title' => 'product_sku_delete',
            ],
            [
                'id'    => 214,
                'title' => 'product_sku_access',
            ],
            [
                'id'    => 215,
                'title' => 'order_item_create',
            ],
            [
                'id'    => 216,
                'title' => 'order_item_edit',
            ],
            [
                'id'    => 217,
                'title' => 'order_item_show',
            ],
            [
                'id'    => 218,
                'title' => 'order_item_delete',
            ],
            [
                'id'    => 219,
                'title' => 'order_item_access',
            ],
            [
                'id'    => 220,
                'title' => 'drawer_movement_create',
            ],
            [
                'id'    => 221,
                'title' => 'drawer_movement_edit',
            ],
            [
                'id'    => 222,
                'title' => 'drawer_movement_show',
            ],
            [
                'id'    => 223,
                'title' => 'drawer_movement_delete',
            ],
            [
                'id'    => 224,
                'title' => 'drawer_movement_access',
            ],
            [
                'id'    => 225,
                'title' => 'shipping_container_create',
            ],
            [
                'id'    => 226,
                'title' => 'shipping_container_edit',
            ],
            [
                'id'    => 227,
                'title' => 'shipping_container_show',
            ],
            [
                'id'    => 228,
                'title' => 'shipping_container_delete',
            ],
            [
                'id'    => 229,
                'title' => 'shipping_container_access',
            ],
            [
                'id'    => 230,
                'title' => 'price_management_access',
            ],
            [
                'id'    => 231,
                'title' => 'order_status_create',
            ],
            [
                'id'    => 232,
                'title' => 'order_status_edit',
            ],
            [
                'id'    => 233,
                'title' => 'order_status_show',
            ],
            [
                'id'    => 234,
                'title' => 'order_status_delete',
            ],
            [
                'id'    => 235,
                'title' => 'order_status_access',
            ],
            [
                'id'    => 236,
                'title' => 'order_config_access',
            ],
            [
                'id'    => 237,
                'title' => 'price_list_type_create',
            ],
            [
                'id'    => 238,
                'title' => 'price_list_type_edit',
            ],
            [
                'id'    => 239,
                'title' => 'price_list_type_show',
            ],
            [
                'id'    => 240,
                'title' => 'price_list_type_delete',
            ],
            [
                'id'    => 241,
                'title' => 'price_list_type_access',
            ],
            [
                'id'    => 242,
                'title' => 'base_style_create',
            ],
            [
                'id'    => 243,
                'title' => 'base_style_edit',
            ],
            [
                'id'    => 244,
                'title' => 'base_style_show',
            ],
            [
                'id'    => 245,
                'title' => 'base_style_delete',
            ],
            [
                'id'    => 246,
                'title' => 'base_style_access',
            ],
            [
                'id'    => 247,
                'title' => 'order_role_create',
            ],
            [
                'id'    => 248,
                'title' => 'order_role_edit',
            ],
            [
                'id'    => 249,
                'title' => 'order_role_show',
            ],
            [
                'id'    => 250,
                'title' => 'order_role_delete',
            ],
            [
                'id'    => 251,
                'title' => 'order_role_access',
            ],
            [
                'id'    => 252,
                'title' => 'complaint_config_access',
            ],
            [
                'id'    => 253,
                'title' => 'complaint_status_create',
            ],
            [
                'id'    => 254,
                'title' => 'complaint_status_edit',
            ],
            [
                'id'    => 255,
                'title' => 'complaint_status_show',
            ],
            [
                'id'    => 256,
                'title' => 'complaint_status_delete',
            ],
            [
                'id'    => 257,
                'title' => 'complaint_status_access',
            ],
            [
                'id'    => 258,
                'title' => 'price_list_group_create',
            ],
            [
                'id'    => 259,
                'title' => 'price_list_group_edit',
            ],
            [
                'id'    => 260,
                'title' => 'price_list_group_show',
            ],
            [
                'id'    => 261,
                'title' => 'price_list_group_delete',
            ],
            [
                'id'    => 262,
                'title' => 'price_list_group_access',
            ],
            [
                'id'    => 263,
                'title' => 'company_role_create',
            ],
            [
                'id'    => 264,
                'title' => 'company_role_edit',
            ],
            [
                'id'    => 265,
                'title' => 'company_role_show',
            ],
            [
                'id'    => 266,
                'title' => 'company_role_delete',
            ],
            [
                'id'    => 267,
                'title' => 'company_role_access',
            ],
            [
                'id'    => 268,
                'title' => 'component_part_name_create',
            ],
            [
                'id'    => 269,
                'title' => 'component_part_name_edit',
            ],
            [
                'id'    => 270,
                'title' => 'component_part_name_show',
            ],
            [
                'id'    => 271,
                'title' => 'component_part_name_delete',
            ],
            [
                'id'    => 272,
                'title' => 'component_part_name_access',
            ],
            [
                'id'    => 273,
                'title' => 'product_size_name_create',
            ],
            [
                'id'    => 274,
                'title' => 'product_size_name_edit',
            ],
            [
                'id'    => 275,
                'title' => 'product_size_name_show',
            ],
            [
                'id'    => 276,
                'title' => 'product_size_name_delete',
            ],
            [
                'id'    => 277,
                'title' => 'product_size_name_access',
            ],
            [
                'id'    => 278,
                'title' => 'equipment_management_access',
            ],
            [
                'id'    => 279,
                'title' => 'equipment_type_create',
            ],
            [
                'id'    => 280,
                'title' => 'equipment_type_edit',
            ],
            [
                'id'    => 281,
                'title' => 'equipment_type_show',
            ],
            [
                'id'    => 282,
                'title' => 'equipment_type_delete',
            ],
            [
                'id'    => 283,
                'title' => 'equipment_type_access',
            ],
            [
                'id'    => 284,
                'title' => 'equipment_create',
            ],
            [
                'id'    => 285,
                'title' => 'equipment_edit',
            ],
            [
                'id'    => 286,
                'title' => 'equipment_show',
            ],
            [
                'id'    => 287,
                'title' => 'equipment_delete',
            ],
            [
                'id'    => 288,
                'title' => 'equipment_access',
            ],
            [
                'id'    => 289,
                'title' => 'equipment_audit_create',
            ],
            [
                'id'    => 290,
                'title' => 'equipment_audit_edit',
            ],
            [
                'id'    => 291,
                'title' => 'equipment_audit_show',
            ],
            [
                'id'    => 292,
                'title' => 'equipment_audit_delete',
            ],
            [
                'id'    => 293,
                'title' => 'equipment_audit_access',
            ],
            [
                'id'    => 294,
                'title' => 'document_management_access',
            ],
            [
                'id'    => 295,
                'title' => 'document_config_access',
            ],
            [
                'id'    => 296,
                'title' => 'document_type_create',
            ],
            [
                'id'    => 297,
                'title' => 'document_type_edit',
            ],
            [
                'id'    => 298,
                'title' => 'document_type_show',
            ],
            [
                'id'    => 299,
                'title' => 'document_type_delete',
            ],
            [
                'id'    => 300,
                'title' => 'document_type_access',
            ],
            [
                'id'    => 301,
                'title' => 'file_type_create',
            ],
            [
                'id'    => 302,
                'title' => 'file_type_edit',
            ],
            [
                'id'    => 303,
                'title' => 'file_type_show',
            ],
            [
                'id'    => 304,
                'title' => 'file_type_delete',
            ],
            [
                'id'    => 305,
                'title' => 'file_type_access',
            ],
            [
                'id'    => 306,
                'title' => 'document_create',
            ],
            [
                'id'    => 307,
                'title' => 'document_edit',
            ],
            [
                'id'    => 308,
                'title' => 'document_show',
            ],
            [
                'id'    => 309,
                'title' => 'document_delete',
            ],
            [
                'id'    => 310,
                'title' => 'document_access',
            ],
            [
                'id'    => 311,
                'title' => 'price_list_create',
            ],
            [
                'id'    => 312,
                'title' => 'price_list_edit',
            ],
            [
                'id'    => 313,
                'title' => 'price_list_show',
            ],
            [
                'id'    => 314,
                'title' => 'price_list_delete',
            ],
            [
                'id'    => 315,
                'title' => 'price_list_access',
            ],
            [
                'id'    => 316,
                'title' => 'product_code_group_create',
            ],
            [
                'id'    => 317,
                'title' => 'product_code_group_edit',
            ],
            [
                'id'    => 318,
                'title' => 'product_code_group_show',
            ],
            [
                'id'    => 319,
                'title' => 'product_code_group_delete',
            ],
            [
                'id'    => 320,
                'title' => 'product_code_group_access',
            ],
            [
                'id'    => 321,
                'title' => 'product_function_create',
            ],
            [
                'id'    => 322,
                'title' => 'product_function_edit',
            ],
            [
                'id'    => 323,
                'title' => 'product_function_show',
            ],
            [
                'id'    => 324,
                'title' => 'product_function_delete',
            ],
            [
                'id'    => 325,
                'title' => 'product_function_access',
            ],
            [
                'id'    => 326,
                'title' => 'product_development_stage_create',
            ],
            [
                'id'    => 327,
                'title' => 'product_development_stage_edit',
            ],
            [
                'id'    => 328,
                'title' => 'product_development_stage_show',
            ],
            [
                'id'    => 329,
                'title' => 'product_development_stage_delete',
            ],
            [
                'id'    => 330,
                'title' => 'product_development_stage_access',
            ],
            [
                'id'    => 331,
                'title' => 'packaging_management_access',
            ],
            [
                'id'    => 332,
                'title' => 'packaging_config_access',
            ],
            [
                'id'    => 333,
                'title' => 'packaging_type_create',
            ],
            [
                'id'    => 334,
                'title' => 'packaging_type_edit',
            ],
            [
                'id'    => 335,
                'title' => 'packaging_type_show',
            ],
            [
                'id'    => 336,
                'title' => 'packaging_type_delete',
            ],
            [
                'id'    => 337,
                'title' => 'packaging_type_access',
            ],
            [
                'id'    => 338,
                'title' => 'packaging_create',
            ],
            [
                'id'    => 339,
                'title' => 'packaging_edit',
            ],
            [
                'id'    => 340,
                'title' => 'packaging_show',
            ],
            [
                'id'    => 341,
                'title' => 'packaging_delete',
            ],
            [
                'id'    => 342,
                'title' => 'packaging_access',
            ],
            [
                'id'    => 343,
                'title' => 'price_config_access',
            ],
            [
                'id'    => 344,
                'title' => 'price_create',
            ],
            [
                'id'    => 345,
                'title' => 'price_edit',
            ],
            [
                'id'    => 346,
                'title' => 'price_show',
            ],
            [
                'id'    => 347,
                'title' => 'price_delete',
            ],
            [
                'id'    => 348,
                'title' => 'price_access',
            ],
            [
                'id'    => 349,
                'title' => 'fabric_group_create',
            ],
            [
                'id'    => 350,
                'title' => 'fabric_group_edit',
            ],
            [
                'id'    => 351,
                'title' => 'fabric_group_show',
            ],
            [
                'id'    => 352,
                'title' => 'fabric_group_delete',
            ],
            [
                'id'    => 353,
                'title' => 'fabric_group_access',
            ],
            [
                'id'    => 354,
                'title' => 'department_create',
            ],
            [
                'id'    => 355,
                'title' => 'department_edit',
            ],
            [
                'id'    => 356,
                'title' => 'department_show',
            ],
            [
                'id'    => 357,
                'title' => 'department_delete',
            ],
            [
                'id'    => 358,
                'title' => 'department_access',
            ],
            [
                'id'    => 359,
                'title' => 'bank_account_create',
            ],
            [
                'id'    => 360,
                'title' => 'bank_account_edit',
            ],
            [
                'id'    => 361,
                'title' => 'bank_account_show',
            ],
            [
                'id'    => 362,
                'title' => 'bank_account_delete',
            ],
            [
                'id'    => 363,
                'title' => 'bank_account_access',
            ],
            [
                'id'    => 364,
                'title' => 'fabric_create',
            ],
            [
                'id'    => 365,
                'title' => 'fabric_edit',
            ],
            [
                'id'    => 366,
                'title' => 'fabric_show',
            ],
            [
                'id'    => 367,
                'title' => 'fabric_delete',
            ],
            [
                'id'    => 368,
                'title' => 'fabric_access',
            ],
            [
                'id'    => 369,
                'title' => 'fabric_price_band_create',
            ],
            [
                'id'    => 370,
                'title' => 'fabric_price_band_edit',
            ],
            [
                'id'    => 371,
                'title' => 'fabric_price_band_show',
            ],
            [
                'id'    => 372,
                'title' => 'fabric_price_band_delete',
            ],
            [
                'id'    => 373,
                'title' => 'fabric_price_band_access',
            ],
            [
                'id'    => 374,
                'title' => 'fabric_nickname_create',
            ],
            [
                'id'    => 375,
                'title' => 'fabric_nickname_edit',
            ],
            [
                'id'    => 376,
                'title' => 'fabric_nickname_show',
            ],
            [
                'id'    => 377,
                'title' => 'fabric_nickname_delete',
            ],
            [
                'id'    => 378,
                'title' => 'fabric_nickname_access',
            ],
            [
                'id'    => 379,
                'title' => 'product_group_create',
            ],
            [
                'id'    => 380,
                'title' => 'product_group_edit',
            ],
            [
                'id'    => 381,
                'title' => 'product_group_show',
            ],
            [
                'id'    => 382,
                'title' => 'product_group_delete',
            ],
            [
                'id'    => 383,
                'title' => 'product_group_access',
            ],
            [
                'id'    => 384,
                'title' => 'bed_sizes_by_region_create',
            ],
            [
                'id'    => 385,
                'title' => 'bed_sizes_by_region_edit',
            ],
            [
                'id'    => 386,
                'title' => 'bed_sizes_by_region_show',
            ],
            [
                'id'    => 387,
                'title' => 'bed_sizes_by_region_delete',
            ],
            [
                'id'    => 388,
                'title' => 'bed_sizes_by_region_access',
            ],
            [
                'id'    => 389,
                'title' => 'bed_size_group_create',
            ],
            [
                'id'    => 390,
                'title' => 'bed_size_group_edit',
            ],
            [
                'id'    => 391,
                'title' => 'bed_size_group_show',
            ],
            [
                'id'    => 392,
                'title' => 'bed_size_group_delete',
            ],
            [
                'id'    => 393,
                'title' => 'bed_size_group_access',
            ],
            [
                'id'    => 394,
                'title' => 'inspection_management_access',
            ],
            [
                'id'    => 395,
                'title' => 'inspection_create',
            ],
            [
                'id'    => 396,
                'title' => 'inspection_edit',
            ],
            [
                'id'    => 397,
                'title' => 'inspection_show',
            ],
            [
                'id'    => 398,
                'title' => 'inspection_delete',
            ],
            [
                'id'    => 399,
                'title' => 'inspection_access',
            ],
            [
                'id'    => 400,
                'title' => 'ordertype_create',
            ],
            [
                'id'    => 401,
                'title' => 'ordertype_edit',
            ],
            [
                'id'    => 402,
                'title' => 'ordertype_show',
            ],
            [
                'id'    => 403,
                'title' => 'ordertype_delete',
            ],
            [
                'id'    => 404,
                'title' => 'ordertype_access',
            ],
            [
                'id'    => 405,
                'title' => 'product_type_create',
            ],
            [
                'id'    => 406,
                'title' => 'product_type_edit',
            ],
            [
                'id'    => 407,
                'title' => 'product_type_show',
            ],
            [
                'id'    => 408,
                'title' => 'product_type_delete',
            ],
            [
                'id'    => 409,
                'title' => 'product_type_access',
            ],
            [
                'id'    => 410,
                'title' => 'product_sku_letter_create',
            ],
            [
                'id'    => 411,
                'title' => 'product_sku_letter_edit',
            ],
            [
                'id'    => 412,
                'title' => 'product_sku_letter_show',
            ],
            [
                'id'    => 413,
                'title' => 'product_sku_letter_delete',
            ],
            [
                'id'    => 414,
                'title' => 'product_sku_letter_access',
            ],
            [
                'id'    => 415,
                'title' => 'component_part_create',
            ],
            [
                'id'    => 416,
                'title' => 'component_part_edit',
            ],
            [
                'id'    => 417,
                'title' => 'component_part_show',
            ],
            [
                'id'    => 418,
                'title' => 'component_part_delete',
            ],
            [
                'id'    => 419,
                'title' => 'component_part_access',
            ],
            [
                'id'    => 420,
                'title' => 'staff_management_access',
            ],
            [
                'id'    => 421,
                'title' => 'supplier_audit_create',
            ],
            [
                'id'    => 422,
                'title' => 'supplier_audit_edit',
            ],
            [
                'id'    => 423,
                'title' => 'supplier_audit_show',
            ],
            [
                'id'    => 424,
                'title' => 'supplier_audit_delete',
            ],
            [
                'id'    => 425,
                'title' => 'supplier_audit_access',
            ],
            [
                'id'    => 426,
                'title' => 'inspection_status_create',
            ],
            [
                'id'    => 427,
                'title' => 'inspection_status_edit',
            ],
            [
                'id'    => 428,
                'title' => 'inspection_status_show',
            ],
            [
                'id'    => 429,
                'title' => 'inspection_status_delete',
            ],
            [
                'id'    => 430,
                'title' => 'inspection_status_access',
            ],
            [
                'id'    => 431,
                'title' => 'inspection_config_access',
            ],
            [
                'id'    => 432,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
