<template>
    <div @mouseover="mouseover" @mouseleave="mouseleave">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <left-nav-list-group :role_permissions="['admin']" :icon="`fa fa-home`" :text="`Dashboard`" :alert_count="0">
                <left-nav-list-item :to="'AdminDashboard'" :text="'Analytics'" />
            </left-nav-list-group>

            <left-nav-list-group :role_permissions="['super_admin','admin']" :icon="`fa fa-users`" :text="`Users`" :alert_count="0">
                <left-nav-list-item :to="'AllUser'" :text="'All users'" />
                <left-nav-list-item :to="'CreateUser'" :text="'Create user'" />
            </left-nav-list-group>

            <left-nav-list-group :role_permissions="['super_admin','admin']" :icon="`fa fa-envelope`" :text="`Contact Message`" :alert_count="0">
                <left-nav-list-item :to="'AllContactMessage'" :text="'All'" />
            </left-nav-list-group>

            <li class="navigation-header">
                <span data-i18n="Apps &amp; Pages">managements</span>
            </li>

            <left-nav-list-group :role_permissions="['admin']" :icon="`fa fa-shop`" :text="`Inventory`" :alert_count="0">
                <left-nav-list-item :to="'AllAdminProduct'" :text="'All Products'" />
                <left-nav-list-item :to="'AllAdminProductCategory'" :text="'Product Category'" />
                <left-nav-list-item :to="'AllAdminWriter'" :text="'Product Writer'" />
                <left-nav-list-item :to="'AllAdminTranslator'" :text="'Product Translator'" />
                <left-nav-list-item :to="'SetDiscountAdminProduct'" :text="'Set Discount'" />
                <left-nav-list-item :to="'PricingAdminProduct'" :text="'Set Price'" />
            </left-nav-list-group>

            <left-nav-list-group :role_permissions="['admin']" :icon="`fa fa-shopping-cart`" :text="`Orders`" :alert_count="0">
                <left-nav-list-item :to="'CreateAdminOrder'" :text="'Create New Order'" />
                <left-nav-list-item :to="'BranchOrder'" :text="'Branch Orders'" />
                <left-nav-list-item :to="'AllEcommerceAdminOrder'" :text="'Ecommerce Orders'" />
            </left-nav-list-group>

            <left-nav-list-group :role_permissions="['admin']" :icon="`fa fa-dollar`" :text="`Accounts`" :alert_count="0">
                <left-nav-list-item :to="'BranchDue'" :text="'All Dues'" />
                <left-nav-list-item :to="'AllAdminPaymentRequest'" :text="'Payment Requests'" />
                <left-nav-list-item :to="'UploadPayments'" :text="'Upload Payments'" />
                <!-- <left-nav-list-item :to="'AllAdminAccount'" :text="'Income & expenses'" /> -->
                <!-- <left-nav-list-item :to="'AllAdminAccountCategory'" :text="'Categories'" /> -->
                <!-- <left-nav-list-item :to="'AllAdminAccountBank'" :text="'Accounts'" /> -->
            </left-nav-list-group>

            <left-nav-list-single :to="'AllAdminSetting'" :icon="'fas fa-gears'" :text="`Settings`" :role_permissions="['admin']"></left-nav-list-single>

            <li class="nav-item">
                <a @click.prevent="fetch_logout()" class="d-flex align-items-center" href="#">
                    <i class="fa-solid fa-power-off"></i>
                    <span class="menu-title text-truncate" >Logout</span>
                </a>
            </li>
        </ul>

        <nav-time-left-watch></nav-time-left-watch>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import LeftNavListGroup from '../../LeftNavListGroup.vue';
import LeftNavListItem from '../../LeftNavListItem.vue';
import LeftNavListSingle from '../../LeftNavListSingle.vue';
import NavTimeLeftWatch from "../../NavTimeLeftWatch.vue";

export default{
    components: { NavTimeLeftWatch, LeftNavListItem, LeftNavListGroup, LeftNavListSingle },
    data: function(){
        return {
            html: null,
        }
    },
    created: function(){
        this.html = document.querySelector('html');
    },
    methods: {
        ...mapActions(['fetch_logout']),
        mouseover: function(){
            let nav_hide = this.html.classList.contains('nav-hide');
            if(nav_hide){
                this.html.classList.add('nav-hide-hover');
                this.html.classList.remove('nav-hide');
            }
        },
        mouseleave: function(){
            let nav_hide_hover = this.html.classList.contains('nav-hide-hover');
            if(nav_hide_hover){
                this.html.classList.add('nav-hide');
                this.html.classList.remove('nav-hide-hover');
            }
        },
    }
}
</script>

<style>

</style>
