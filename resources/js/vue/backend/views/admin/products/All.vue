<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                <h4>
                    All
                    <small v-if="this[`get_${store_prefix}_selected`].length">
                        &nbsp; selected:
                        <b class="text-warning">
                            {{ this[`get_${store_prefix}_selected`].length }}
                        </b>
                        &nbsp;
                        <b @click="call_store(`set_clear_selected_${store_prefix}s`, true)" class="text-danger cursor-pointer">clear</b>
                        &nbsp;
                        <b @click="call_store(`set_${store_prefix}_show_selected`,true)" class="text-success cursor-pointer">show</b>
                    </small>
                </h4>
                <div class="search">
                    <form action="#">
                        <input @keyup="call_store(`set_${store_prefix}_search_key`,$event.target.value)" class="form-control border border-info" placeholder="search..." type="search">
                    </form>
                </div>
                <div class="btns d-flex gap-2 align-items-center">
                    <permission-button
                        :permission="'can_create'"
                        :to="{name: `Create${route_prefix}`}"
                        :classList="'btn rounded-pill btn-outline-info'">
                        <i class="fa fa-pencil me-5px"></i>
                        Create
                    </permission-button>
                    <div class="table_actions">
                        <a href="#" @click.prevent="()=>''" class="btn px-1 btn-outline-secondary">
                            <i class="fa fa-list"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="" @click.prevent="call_store(`export_${store_prefix}_all`)">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Export All
                                </a>
                            </li>
                            <li v-if="this[`get_${store_prefix}_selected`].length">
                                <a href="" @click.prevent="call_store(`export_selected_${store_prefix}_csv`)">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Export Selected
                                </a>
                            </li>
                            <li>
                                <router-link :to="{name:`Import${route_prefix}`}">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Import
                                </router-link>
                            </li>
                            <li>
                                <a href="#" v-if="this[`get_${store_prefix}_show_active_data`]" title="display data that has been deactivated" @click.prevent="call_store(`set_${store_prefix}_show_active_data`,0)" class="d-flex">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Deactivated data
                                </a>
                                <a href="#" v-else title="display data that are active" @click.prevent="call_store(`set_${store_prefix}_show_active_data`,1)" class="d-flex">
                                    <i class="fa-regular fa-hand-point-right"></i>
                                    Active data
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="table-responsive card-body text-nowrap">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th><input @click="call_store(`set_select_all_${store_prefix}s`)" type="checkbox" class="form-check-input check_all"></th>
                            <table-th :sort="true" :tkey="'id'" :title="'ID'" :ariaLable="'id'"/>
                            <table-th :sort="true" :tkey="'is_top_product'" :title="'Top Pro'" :ariaLable="'id'"/>
                            <table-th :sort="true" :tkey="'is_public'" :title="'Pub Pro'" :ariaLable="'id'"/>
                            <table-th :sort="false" :tkey="'thumb_image'" :title="'Image'" />
                            <table-th :sort="false" :tkey="'product_name'" :title="'Title'" />

                            <table-th :sort="false" :tkey="'sales_price'" :title="'Sales Price'" />
                            <table-th :sort="false" :tkey="''" :title="'discount %'" />
                            <table-th :sort="false" :tkey="''" :title="'discount ৳'" />
                            <table-th :sort="false" :tkey="''" :title="'current price'" />

                            <table-th :sort="false" :tkey="''" :title="'stock'" />
                            <table-th :sort="false" :tkey="''" :title="'sales'" />
                            <table-th :sort="false" :tkey="''" :title="'returns'" />
                            <table-th :sort="false" :tkey="''" :title="'Current stock'" />

                            <table-th :sort="false" :tkey="''" :title="'ISBN'" />
                            <table-th :sort="false" :tkey="''" :title="'SKU'" />
                            <table-th :sort="true" :tkey="'status'" :title="'Status'" />
                            <th aria-label="actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <template v-for="item in this[`get_${store_prefix}s`].data">
                            <tr :key="item.id" >
                                <td :class="{'stock_alert': item.is_low_stock}">
                                    <div class="stock_badge" v-if="item.is_low_stock" :class="{'badge rounded-pill': item.is_low_stock}">
                                        stock out
                                    </div>
                                    <input v-if="check_if_data_is_selected(item)" :data-id="item.id" checked @change="call_store(`set_selected_${store_prefix}s`,item)" type="checkbox" class="form-check-input">
                                    <input v-else @change="call_store(`set_selected_${store_prefix}s`,item)" type="checkbox" class="form-check-input">
                                </td>
                                <td>{{ item.id }}</td>
                                <td>
                                    <input v-if="item.is_top_product" @change="admin_add_to_top_product({id:item.id, value: $event.target.checked})" checked class="form-check-input" type="checkbox">
                                    <input v-else @change="admin_add_to_top_product({id:item.id, value: $event.target.checked})" class="form-check-input" type="checkbox">
                                </td>
                                <td>
                                    <input v-if="item.is_public" @change="admin_add_to_public({id:item.id, value: $event.target.checked})" checked class="form-check-input" type="checkbox">
                                    <input v-else @change="admin_add_to_public({id:item.id, value: $event.target.checked})" class="form-check-input" type="checkbox">
                                </td>
                                <td>
                                    <img style="height: 60px;" :src="`/${item.thumb_image}`" alt="">
                                </td>
                                <td class="position_sticky">
                                    <span class="text-warning cursor_pointer" @click.prevent="call_store(`set_${store_prefix}`,item)">
                                        {{ item.product_name }}
                                    </span>
                                </td>

                                <td>
                                    <b class="text-success">
                                        {{ item.sales_price }}
                                    </b>
                                </td>
                                <td>
                                    <b class="text-primary">
                                        {{ item.discount_info && item.discount_info.discount_percent }}%
                                    </b>
                                </td>
                                <td>
                                    <b class="text-info">
                                        - {{ item.discount_info && item.discount_info.discount_amount }} ৳
                                    </b>
                                </td>
                                <td>
                                    <b class="text-info">
                                        {{ item.discount_info.discount_price ? item.discount_info.discount_price: item.sales_price }} ৳
                                    </b>
                                </td>

                                <td>
                                    <b class="text-">
                                        + {{ item.stock }}
                                    </b>
                                </td>
                                <td>- {{ item.sales }}</td>
                                <td>
                                    <b class="text-danger">
                                        + {{ item.returns }}
                                    </b>
                                </td>
                                <td>
                                    <b class="text-success">
                                        = {{ item.final_stock }}
                                    </b>
                                </td>

                                <td>{{ item.isbn  }}</td>
                                <td>{{ item.sku }}</td>

                                <td>
                                    <span v-if="item.status == 1" class="badge bg-label-success me-1">active</span>
                                    <span v-if="item.status == 0" class="badge bg-label-success me-1">deactive</span>
                                </td>
                                <td>
                                    <div class="table_actions">
                                        <a href="#" @click.prevent="()=>''" class="btn btn-sm btn-outline-secondary">
                                            <i class="fa fa-gears"></i>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="" @click.prevent="call_store(`set_${store_prefix}`,item)">
                                                    <i class="fa text-info fa-eye"></i>
                                                    Quick View
                                                </a>
                                            </li>
                                            <li>
                                                <permission-button
                                                    :permission="'can_edit'"
                                                    :to="{name:`Details${route_prefix}`,params:{id:item.id}}"
                                                    :classList="''">
                                                    <i class="fa text-secondary fa-eye"></i>
                                                    Details
                                                </permission-button>
                                            </li>
                                            <li>
                                                <permission-button
                                                    :permission="'can_edit'"
                                                    :to="{name:`Edit${route_prefix}`,params:{id: item.id}}"
                                                    :classList="''">
                                                    <i class="fa text-warning fa-pencil"></i>
                                                    Edit
                                                </permission-button>
                                            </li>
                                            <li v-if="item.status == 1">
                                                <permission-button
                                                    :permission="'can_delete'"
                                                    :to="{}"
                                                    :click="()=>call_store(`soft_delete_${store_prefix}`,item.id)"
                                                    :click_param="item.id"
                                                    :classList="''">
                                                    <i class="fa text-danger fa-trash"></i>
                                                    Deactive
                                                </permission-button>
                                            </li>
                                            <li v-else>
                                                <permission-button
                                                    :permission="'can_delete'"
                                                    :to="{}"
                                                    :click="()=>call_store(`restore_${store_prefix}`,item.id)"
                                                    :click_param="item.id"
                                                    :classList="''">
                                                    <i class="fa text-danger fa-recycle"></i>
                                                    Activate
                                                </permission-button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div class="card-footer py-1 border-top-0">
                <div class="d-inline-block">
                    <pagination :data="this[`get_${store_prefix}s`]" :limit="5" :size="'small'" :show-disabled="true" :align="'left'"
                        @pagination-change-page="handle_pagination">
                        <span slot="prev-nav"><i class="fa fa-angle-left"></i> Previous</span>
                        <span slot="next-nav">Next <i class="fa fa-angle-right"></i></span>
                    </pagination>
                </div>
                <div class="show-limit d-inline-block">
                    <span>Limit:</span>
                    <select @change.prevent="call_store(`set_${store_prefix}_paginate`,$event.target.value)">
                        <option v-for="i in [10,5,25,50,100]" :key="i" :value="i">
                            {{ i }}
                        </option>
                    </select>
                </div>
                <div class="show-limit d-inline-block">
                    <span>Total:</span>
                    <span>{{ this[`get_${store_prefix}s`].total }}</span>
                </div>
            </div>
        </div>

        <details-canvas/>
        <selected-canvas/>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';
import PermissionButton from '../../components/PermissionButton.vue';
import TableTh from './components/TableTh.vue';
import DetailsCanvas from './DetailsCanvas.vue';
import SelectedCanvas from './SelectedCanvas.vue';

/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { PermissionButton, TableTh, DetailsCanvas, SelectedCanvas },
    data: function(){
        return {
            store_prefix,
            route_prefix,
        }
    },
    created: function(){
        this[`fetch_${store_prefix}s`]();
    },
    methods: {
        ...mapActions([
            `fetch_${store_prefix}s`,
            `soft_delete_${store_prefix}`,
            `restore_${store_prefix}`,
            `export_${store_prefix}_all`,
            `export_selected_${store_prefix}_csv`,
            `admin_add_to_top_product`,
            `admin_add_to_public`,
        ]),
        ...mapMutations([
            `set_${store_prefix}_paginate`,
            `set_${store_prefix}_page`,
            `set_${store_prefix}_search_key`,
            `set_${store_prefix}_orderByCol`,
            `set_${store_prefix}_show_active_data`,
            `set_${store_prefix}`,
            `set_selected_${store_prefix}s`,
            `set_select_all_${store_prefix}s`,
            `set_clear_selected_${store_prefix}s`,
            `set_${store_prefix}_show_selected`,
        ]),

        call_store: function(name, params=null){
            this[name](params)
        },
        handle_pagination: function(page=1){
            return this[`set_${store_prefix}_page`](page);
        },

        check_if_data_is_selected: function(user){
            let check_index = this[`get_${store_prefix}_selected`].findIndex((i) => i.id == user.id);
            if(check_index >= 0){
                return true;
            }else{
                return false;
            }
        },
    },
    computed: {
        ...mapGetters([
            `get_${store_prefix}s`,
            `get_${store_prefix}_selected`,
            `get_${store_prefix}_show_active_data`,
        ]),
        ...mapGetters({
            data: `get_${store_prefix}s`,
            selected_data: `get_${store_prefix}_selected`,
        }),
    }
}
</script>

<style>

</style>

PermissionButton
