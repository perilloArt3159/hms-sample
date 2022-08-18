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

                    <b-modal id="modal-create" title="Add Hotel" @show="resetModalCreate" @hidden="resetModalCreate"
                        @ok="handleModalCreateOk">
                        <form ref="formCreate" @submit.stop.prevent="handleFormCreateSubmit">
                            <b-form-group label="Name" label-for="name-input" invalid-feedback="Name is required"
                                :state="formCreateState.name">
                                <b-form-input id="name-input" v-model="formCreateData.name" placeholder="Enter Name"
                                    required :state="formCreateState.name">
                                </b-form-input>
                            </b-form-group>
                            <b-form-group label="Address" label-for="address-input"
                                invalid-feedback="Address is required" :state="formCreateState.address">
                                <b-form-textarea id="address-input" v-model="formCreateData.address" rows="3"
                                    placeholder="Enter Address..." required :state="formCreateState.address">

                                </b-form-textarea>
                            </b-form-group>
                        </form>
                    </b-modal>

                </div>

                <!-- User Interface controls -->
                <b-row>
                    <b-col lg="6" class="my-1">
                        <b-form-group label="Sort" label-for="sort-by-select" label-cols-sm="3" label-align-sm="right"
                            label-size="sm" class="mb-0" v-slot="{ ariaDescribedby }">
                            <b-input-group size="sm">
                                <b-form-select id="sort-by-select" v-model="sortBy" :options="sortOptions"
                                    :aria-describedby="ariaDescribedby" class="w-75">
                                    <template #first>
                                        <option value="">-- none --</option>
                                    </template>
                                </b-form-select>

                                <b-form-select v-model="sortDesc" :disabled="!sortBy"
                                    :aria-describedby="ariaDescribedby" size="sm" class="w-25">
                                    <option :value="false">Asc</option>
                                    <option :value="true">Desc</option>
                                </b-form-select>
                            </b-input-group>
                        </b-form-group>
                    </b-col>

                    <b-col lg="6" class="my-1">
                        <b-form-group label="Initial sort" label-for="initial-sort-select" label-cols-sm="3"
                            label-align-sm="right" label-size="sm" class="mb-0">
                            <b-form-select id="initial-sort-select" v-model="sortDirection"
                                :options="['asc', 'desc', 'last']" size="sm"></b-form-select>
                        </b-form-group>
                    </b-col>

                    <b-col lg="6" class="my-1">
                        <b-form-group label="Filter" label-for="filter-input" label-cols-sm="3" label-align-sm="right"
                            label-size="sm" class="mb-0">
                            <b-input-group size="sm">
                                <b-form-input id="filter-input" v-model="filter" type="search"
                                    placeholder="Type to Search">
                                </b-form-input>

                                <b-input-group-append>
                                    <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                                </b-input-group-append>
                            </b-input-group>
                        </b-form-group>
                    </b-col>

                    <b-col lg="6" class="my-1">
                        <b-form-group v-model="sortDirection" label="Filter On"
                            description="Leave all unchecked to filter on all data" label-cols-sm="3"
                            label-align-sm="right" label-size="sm" class="mb-0" v-slot="{ ariaDescribedby }">
                            <b-form-checkbox-group v-model="filterOn" :aria-describedby="ariaDescribedby" class="mt-1">
                                <b-form-checkbox value="name">Name</b-form-checkbox>
                                <b-form-checkbox value="age">Age</b-form-checkbox>
                                <b-form-checkbox value="isActive">Active</b-form-checkbox>
                            </b-form-checkbox-group>
                        </b-form-group>
                    </b-col>

                    <b-col sm="5" md="6" class="my-1">
                        <b-form-group label="Per page" label-for="per-page-select" label-cols-sm="6" label-cols-md="4"
                            label-cols-lg="3" label-align-sm="right" label-size="sm" class="mb-0">
                            <b-form-select id="per-page-select" v-model="perPage" :options="pageOptions" size="sm">
                            </b-form-select>
                        </b-form-group>
                    </b-col>

                    <b-col sm="7" md="6" class="my-1">
                        <b-pagination v-model="currentPage" :total-rows="items.data.pagination.total"
                            :per-page="perPage" align="fill" size="sm" class="my-0">
                        </b-pagination>
                    </b-col>
                </b-row>

                <!-- Main table element -->
                <b-table :items="items.data.items" :fields="fields" :current-page="items.data.pagination.current"
                    :per-page="items.data.pagination.size" :filter="filter" :filter-included-fields="filterOn"
                    :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :sort-direction="sortDirection" stacked="md"
                    show-empty @filtered="onFiltered">
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
                        <b-button size="sm" class="mr-1" variant="info" @click="updateItem(row.item)">
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

                <!-- Info modal -->
                <b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal">
                    <pre>{{ infoModal.content }}</pre>
                </b-modal>

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
                    return { text: f.label, value: f.key }
                })
        }
    },
    data    : () => (
        {
            modalCreateActive: false, 
            modalUpdateActive: false, 
            formCreateData: 
            {
                name   : null,
                address: null,
            },  
            formCreateState: 
            {
                name    : null, 
                address : null
            },
            fields:
            [
                '#',
                {
                    key          : "name",
                    label        : 'Name',
                    sortable     : true,
                },
                {
                    key     : 'address',
                    label   : 'Address',
                    sortable: true,
                },
                {
                    key     : 'createdAt',
                    label   : 'Created At',
                    sortable: true,
                },
                {
                    key  : 'actions',
                    label: 'Actions'
                }
            ],
            totalRows    : 1,
            currentPage  : 1,
            perPage      : 5,
            pageOptions  : [10, 25, 50, { value: 100, text: "Show a lot" }],
            sortBy       : '',
            sortDesc     : false,
            sortDirection: 'asc',
            filter       : null,
            filterOn     : [],
            infoModal:
            {
                id     : 'info-modal',
                title  : '',
                content: ''
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
        updateItem() 
        {
            
        },
        deleteItem: debounce(
            async function (slug) 
            {
                await this.deleteHotel(slug);
                await this.fetchHotels({ requestData: null }); 

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
        resetInfoModal() 
        {
            this.infoModal.title = ''
            this.infoModal.content = ''
        },
        onFiltered(filteredItems) 
        {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
        },
        checkFormCreateValidity()
        {
            const valid = this.$refs.formCreate.checkValidity();

            this.formCreateState.name    = this.formCreateData.name    == null || this.formCreateData.name   == '' ? false : true ;
            this.formCreateState.address = this.formCreateData.address == null || this.formCreateData.address == '' ? false : true;
            return valid;
        },
        resetModalCreate()
        {
            this.formCreateData.name    = null;
            this.formCreateData.address = null;

            this.formCreateState.name    = null;
            this.formCreateState.address = null;
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

                await this.createHotel(this.formCreateData); 
                await this.fetchHotels({ requestData: null }); 

                this.$bvToast.toast(
                    `Record Created`,
                    {
                        title        : 'Success',
                        autoHideDelay: 5000,
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
        )
    },
    mounted: async function () 
    {
        await this.fetchHotels({ requestData: null });
    }
};

</script>