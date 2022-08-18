<template>
    <div>
        <h3 class="font-weight-bold text-secondary">
            Hotels
        </h3>

        <hr class="hr" />

        <template v-if="items!=null">
            <b-container fluid>
                <div>
                    <b-button class="d-flex align-items-center" variant="primary" v-b-modal.modal-create>
                        <i class="bi bi-plus-circle">

                        </i>
                        <span class="ml-2">
                            Create Hotel
                        </span>
                    </b-button>

                    <!-- MODAL CREATE -->
                    <b-modal 
                        id="modal-create" 
                        title="Add Hotel" 
                        @show="resetModalCreate" 
                        @hidden="resetModalCreate"
                        @ok="handleModalCreateOk"
                    >
                        <form 
                            ref="formCreate" 
                            @submit.stop.prevent="handleFormCreateSubmit"
                        >
                            <b-form-group 
                                label="Name" 
                                label-for="name-input" 
                                invalid-feedback="Name is required"
                                :state="formCreate.state.name"
                            >
                                <b-form-input 
                                    id="name-input" 
                                    v-model="formCreate.data.name" 
                                    placeholder="Enter Name"
                                    required 
                                    :state="formCreate.state.name"
                                >
                                </b-form-input>
                            </b-form-group>
                            <b-form-group 
                                label="Address" 
                                label-for="address-input"
                                invalid-feedback="Address is required" 
                                :state="formCreate.state.address"
                            >
                                <b-form-textarea 
                                    id="address-input" 
                                    v-model="formCreate.data.address" 
                                    rows="3"
                                    placeholder="Enter Address..." 
                                    required 
                                    :state="formCreate.state.address"
                                >
                                </b-form-textarea>
                            </b-form-group>
                        </form>
                    </b-modal>
                    <!-- END MODAL CREATE -->


                    <!-- MODAL UPDATE -->
                    <b-modal 
                        id="modal-update" 
                        title="Update Hotel" 
                        @hidden="resetModalUpdate"
                        @ok="handleModalUpdateOk"
                    >
                        <form ref="formUpdate" @submit.stop.prevent="handleFormUpdateSubmit">
                            <b-form-group 
                                label="Name" 
                                label-for="name-input" 
                                invalid-feedback="Name is required"
                                :state="formUpdate.state.name"
                            >
                                <b-form-input 
                                    id="name-input" 
                                    v-model="formUpdate.data.name" 
                                    placeholder="Enter Name"
                                    required 
                                    :state="formUpdate.state.name"
                                >
                                </b-form-input>
                            </b-form-group>
                            <b-form-group 
                                label="Address" 
                                label-for="address-input"
                                invalid-feedback="Address is required" 
                                :state="formUpdate.state.address"
                            >
                                <b-form-textarea 
                                    id="address-input" 
                                    v-model="formUpdate.data.address" 
                                    rows="3"
                                    placeholder="Enter Address..." 
                                    required 
                                    :state="formUpdate.state.address"
                                >
                                </b-form-textarea>
                            </b-form-group>
                        </form>
                    </b-modal>
                    <!-- END MODAL UPDATE -->

                </div>

                <!-- User Interface controls -->
                <b-row class="my-4">
                    <b-col lg="6" class="my-1">
                        <b-form-group 
                            label="Sort" 
                            label-for="sort-by-select" 
                            label-cols-sm="2" 
                            label-align-sm="center"
                            label-class="font-weight-bold"
                            label-size="sm" 
                            class="mb-0" 
                            v-slot="{ ariaDescribedby }"
                        >
                            <b-input-group size="sm">
                                <b-form-select 
                                    id="sort-by-select" 
                                    v-model="sortBy" 
                                    class="w-75"
                                    :options="sortOptions"
                                    :aria-describedby="ariaDescribedby" 
                                    @change="onPageChange"
                                >
                                    <template #first>
                                        <option value="">-- none --</option>
                                    </template>
                                </b-form-select>

                                <b-form-select 
                                    v-model="sortDesc" 
                                    size="sm" 
                                    class="w-25"
                                    :disabled="!sortBy"
                                    :aria-describedby="ariaDescribedby" 
                                    @change="onPageChange"
                                >
                                    <option :value="false">Asc</option>
                                    <option :value="true">Desc</option>
                                </b-form-select>
                            </b-input-group>
                        </b-form-group>
                    </b-col>              

                    <b-col md="6" class="my-1">
                        <b-form-group 
                            label="Show" 
                            label-for="per-page-select" 
                            label-cols-sm="5" 
                            label-cols-md="4"
                            label-cols-lg="3" 
                            label-class="font-weight-bold"
                            label-align-sm="center" 
                            label-size="sm" 
                            class="mb-0"
                        >
                            <b-form-select 
                                id="per-page-select" 
                                v-model="paginationInfo.perPage" 
                                size="sm"
                                :options="pageOptions" 
                                @change="onPageChange"
                            >
                            </b-form-select>
                        </b-form-group>
                    </b-col>

                    <b-col lg="6" class="my-1">
                        <b-form-group 
                            label="Filter" 
                            label-for="filter-input" 
                            label-cols-sm="2"
                            label-class="font-weight-bold"
                            label-align-sm="center"
                            label-size="sm" 
                            class="mb-0"
                        >
                            <b-input-group size="sm">
                                <b-form-input 
                                    id="filter-input" 
                                    v-model="filter" 
                                    type="search"
                                    placeholder="Type to Search"
                                >
                                </b-form-input>

                                <b-input-group-append>
                                    <b-button :disabled="!filter" @click="filter = null">Clear</b-button>
                                </b-input-group-append>
                            </b-input-group>
                        </b-form-group>
                    </b-col>

                    <b-col sm="7" md="6"  class="my-1">
                        <b-pagination 
                            v-model="paginationInfo.currentPage" 
                            class="my-0"
                            align="fill" 
                            size="sm" 
                            :total-rows="items.data.pagination.total"
                            :per-page="items.data.pagination.size" 
                            @change="onPageChange"
                        >
                        </b-pagination>
                    </b-col>
                </b-row>

                <!-- Main table element -->
                <b-table 
                    :items="items.data.items" 
                    :fields="fields" 
                    :current-page="paginationInfo.currentPage"
                    :per-page="paginationInfo.size" 
                    :filter="filter" 
                    :sort-by.sync="sortBy" 
                    :sort-desc.sync="sortDesc" 
                    :sort-direction="sortDirection" 
                    stacked="md"
                    show-empty 
                    @filtered="onFiltered"
                >

                    <!-- BUSY STATE -->
                    <template #table-busy>
                        <div class="text-center text-danger my-2">
                            <b-spinner class="align-middle" variant="primary" />
                            <strong class="text-primary">Loading...</strong>
                        </div>
                    </template>
                    <!-- END BUSY STATE -->

                    <!-- A virtual column -->
                    <template #cell(#)="row">
                        {{ row.index + 1 }}
                    </template>

                    <template #cell(key)="row">
                        {{ row.value.first }} {{ row.value.last }}
                    </template>

                    <template #cell(actions)="row">
                        <b-button 
                            size="sm" 
                            class="mr-1" 
                            variant="info" 
                            @click="setupFormUpdate(row.item)" 
                            v-b-modal.modal-update
                        >
                            <i class="bi bi-pen-fill fs-6"></i>
                        </b-button>
                        <b-button size="sm" variant="danger" @click="deleteItem(row.item.slug)">
                            <i class="bi bi-trash-fill fs-6"></i>
                        </b-button>
                    </template>

                    <template #row-details="row">
                        <b-card>
                            <ul>
                                <li v-for="(value, key) in row.item" :key="key">
                                    {{ key }}: {{ value }}
                                </li>
                            </ul>
                        </b-card>
                    </template>
                </b-table>

            </b-container>
        </template>

        <template v-else>
            <div class="text-center my-5 d-flex justify-content-center">
                <b-spinner variant="primary" label="Spinning" style="width: 4rem; height: 4rem;">
                </b-spinner>
            </div>
        </template>


    </div>
</template>

<script>

import
{
    mapState,
    mapGetters,
    mapActions,
    mapMutations
}
from 'vuex';

import { debounce } from 'lodash'; 

export default
{
    name    : 'HotelsPage',
    layout  : "dashboard",
    computed:
    {
        ...mapState( 'hotels', ['items']),   

        sortOptions() 
        {
            // Create an options list from our fields
            return this.fields
                .filter(f => f.sortable)
                .map(f => 
                {
                    return { text: f.label, value: f.column }
                })
        }
    },
    data  : () => (
        {
            modalCreateActive: false, 
            modalUpdateActive: false, 
            selectedSlug     : null, 
            formCreate: 
            {
                data :
                {
                    name   : null,
                    address: null,
                },
                state : 
                {
                    name   : null,
                    address: null,
                }
            },  
            formUpdate: 
            {
                data: 
                {
                    name    : null, 
                    address : null
                }, 
                state: 
                {
                    name: null,
                    address: null,
                }
            },
            fields:
            [
                '#',
                {
                    key     : "name",
                    label   : 'Name',
                    column  : 'name',
                    sortable: true,
                },
                {
                    key     : 'address',
                    label   : 'Address',
                    column  : 'address',
                    sortable: true,
                },
                {
                    key     : 'createdAt',
                    label   : 'Created At',
                    column  : 'created_at',
                    sortable: true,
                },
                {
                    key  : 'actions',
                    label: 'Actions'
                }
            ],
            pageOptions:
            [
                {
                    value : 10, 
                    text  : "10 Items"
                }, 
                {
                    value: 25, 
                    text : "25 Items"    
                },
                {
                    value: 50,
                    text: "50 Items" 
                },
                { 
                    value: 100,
                    text: "100 Items" 
                }
            ],
            sortBy       : '',
            sortDesc     : false,
            sortDirection: 'asc',
            filter       : null,
            paginationInfo : 
            {
                perPage    : null,
                currentPage: null,
            }
        }
    ), 
    methods:
    {
        ...mapActions(
            'hotels',
            [
                'fetchHotels',
                'createHotel',
                'updateHotel',
                'deleteHotel'
            ]
        ),
        onPageChange: debounce(
            async function () 
            {
                const requestData = 
                {
                    'search'       : this.filter,
                    'sizePerPage'  : this.paginationInfo.perPage,
                    'showPage'     : this.paginationInfo.currentPage,
                    'sortByColumn' : this.sortBy, 
                    'sortDirection': this.sortDirection 
                }

                await this.fetchHotels(
                    requestData
                ); 
            },
            250
        ),
        setupFormUpdate(row) 
        {
            this.selectedSlug = row.slug; 

            this.formUpdate.data.name    = row.name;
            this.formUpdate.data.address = row.address;
        },
        deleteItem: debounce(
            async function (slug) 
            {
                await this.deleteHotel(slug);
                this.onPageChange();

                this.$bvToast.toast(
                    `Record Deleted`,
                    {
                        title        : 'Success',
                        autoHideDelay: 5000,
                        appendToast  : true,
                        variant      : 'primary'
                    }
                );
            },
            250 
        ),
        onFiltered(filteredItems) 
        {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
        },
        checkFormCreateValidity()
        {
            const valid = this.$refs.formCreate.checkValidity();

            this.formCreate.state.name    = this.formCreate.data.name    == null || this.formCreate.data.name   == '' ? false : true ;
            this.formCreate.state.address = this.formCreate.data.address == null || this.formCreate.data.address == '' ? false : true;

            return valid;
        },
        resetModalCreate()
        {
            this.formCreate.data.name    = null;
            this.formCreate.data.address = null;

            this.formCreate.state.name    = null;
            this.formCreate.state.address = null;
        },
        handleModalCreateOk(bvModalEvent)
        {
            // Prevent modal from closing
            bvModalEvent.preventDefault()

            // Trigger submit handler
            this.handleModalCreateSubmit()
        },
        handleModalCreateSubmit: debounce(
            async function (e) 
            {
                //! Exit when the form isn't valid
                if (!this.checkFormCreateValidity())
                {
                    return
                }

                await this.createHotel(this.formCreate.data); 

                this.onPageChange(); 

                this.$bvToast.toast(
                    `Record Created`,
                    {
                        title        : 'Success',
                        autoHideDelay: 1000,
                        appendToast  : true,
                        variant      : 'primary'
                    }
                );

                //! Hide the modal manually
                this.$nextTick(() =>
                    {
                        this.$bvModal.hide('modal-create')
                    }
                ); 
            },
            250
        ), 
        checkFormUpdateValidity()
        {
            const valid = this.$refs.formUpdate.checkValidity();

            this.formUpdate.state.name = this.formUpdate.data.name == null || this.formUpdate.data.name          == '' ? false : true;
            this.formUpdate.state.address = this.formUpdate.data.address == null || this.formUpdate.data.address == '' ? false : true;

            return valid;
        },
        resetModalUpdate()
        {
            this.formUpdate.data.name = null;
            this.formUpdate.data.address = null;

            this.formUpdate.state.name = null;
            this.formUpdate.state.address = null;
        },
        handleModalUpdateOk(bvModalEvent)
        {
            // Prevent modal from closing
            bvModalEvent.preventDefault()

            // Trigger submit handler
            this.handleModalUpdateSubmit()
        },
        handleModalUpdateSubmit: debounce(
            async function (e) 
            {
                //! Exit when the form isn't valid
                if (!this.checkFormUpdateValidity())
                {
                    return
                }

                await this.updateHotel({requestData : this.formUpdate.data, slug : this.selectedSlug });
                this.onPageChange(); 

                this.$bvToast.toast(
                    `Record Updated`,
                    {
                        title        : 'Success',
                        autoHideDelay: 2000,
                        appendToast  : true,
                        variant      : 'primary'
                    }
                );

                //! Hide the modal manually
                this.$nextTick(() =>
                {
                    this.$bvModal.hide('modal-update')
                }
                );
            },
            250
        )
    },
    mounted: async function () 
    {
        await this.fetchHotels({ requestData: null });

        this.paginationInfo.currentPage = this.items.data.pagination.current;
        this.paginationInfo.perPage     = this.items.data.pagination.size;
    }, 
    watch:
    {
        filter: function (newValue, oldValue)
        {
            this.onPageChange();
        }
    }
};

</script>