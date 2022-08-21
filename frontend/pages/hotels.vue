<template>
    <div>
        <h2 
			class="font-bold text-gray-400 text-3xl my-3 tracking-wider capitalize"
		>
			hotels
		</h2>

		<hr/>

		<div 
            v-if="items"
			class="my-5"
		>
            <!-- CONTROLS-->
            <div class="grid grid-cols-2 grid-rows-2 gap-4 my-2 ">

                <!-- SORT BY -->
                <div class="grid grid-cols-5 gap-2 items-center">
                    <label 
                        for="selectSortBy"
                        class="capitalize font-bold tracking-wider text-gray-400"
                    >
                        Sort By 
                    </label>
                    <div class="col-span-3">
                        <select 
                            v-model="sortBy"
                            id="selectSortBy" 
                            class="form-control form-control-select w-full"
                            @change="onPageChange"
                        >
                            <option :value="null">
                                None
                            </option>
                            <option 
                                v-for="field in fields"
                                :key="field.key"
                                :value="field.column"
                            >
                                {{ field.label }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <select 
                            v-model="sortDirection"
                            id="selectSortDirection" 
                            class="form-control form-control-select w-full"
                            @change="onPageChange"
                        >
                            <option :value="null">
                                None
                            </option>
                            <option 
                                v-for="direction in sortDirections"
                                :key="direction.key"
                                :value="direction.value"
                            >
                                {{ direction.label }}
                            </option>
                        </select>
                    </div>
                </div>
                <!-- END SORT BY-->

                <!-- SHOW ITEMS -->
                <div class="grid grid-cols-5 gap-2 items-center">
                    <label 
                        for="selectShowItems"
                        class="capitalize font-bold tracking-wider text-gray-400"
                    >
                        Show
                    </label>
                    <div class="col-span-4">
                        <select
                            v-model="paginationInfo.perPage" 
                            id="selectShowItems" 
                            class="form-control form-control-select w-full"
                            @change="onPageChange"
                        >
                            <option 
                                v-for="item in pageOptions"
                                :key="item.key"
                                :value="item.value"
                            >
                                {{ item.label }}
                            </option>
                        </select>
                    </div>
                </div>
                <!-- END SHOW ITEMS -->

                <!-- SEARCH -->
                <div class="grid grid-cols-5 gap-2 items-center">
                    <label 
                        for="inputSearch"
                        class="capitalize font-bold tracking-wider text-gray-400 "
                    >
                        Search 
                    </label>
                    <div class="col-span-3">
                        <input
                            v-model="filter"
                            class="form-control form-control-input w-full" 
                            type="text" 
                            id="inputSearch"
                            placeholder="Search Items"
                        >
                    </div>
                    <div class="">
                        <button class="btn btn-red p-2 w-full" @click="filter=null">
                            <i class="bi bi-eraser-fill"></i>
                            <span class="capitalize tracking-wide">clear</span>
                        </button>
                    </div>
                </div>
                <!-- END SEARCH -->

                <!-- PAGINATION-->
                <div class="flex items-center justify-center">
                    <ul class="flex items-center justify-center text-xl">
                        <li 
                            class="bg-blue-400 py-1 px-3 text-white cursor-pointer rounded ease-in duration-200 font-bold mx-1 hover:bg-blue-500 hover:scale-110"
                            @click="paginationPageFirst"        
                        >
                            <i class="bi bi-arrow-bar-left">
                            </i>
                        </li>
                        <li 
                            class="bg-blue-400 py-1 px-3 text-white cursor-pointer rounded ease-in duration-200 font-bold mx-1 hover:bg-blue-500 hover:scale-110"
                            @click="paginationPagePrevious"    
                        > 
                            <i class="bi bi-arrow-left">
                                
                            </i>
                        </li>
                        <li
                            v-for="page in paginationItems"
                            class="py-1 px-3 text-white cursor-pointer rounded ease-in duration-200 font-bold mx-1 hover:bg-blue-500 hover:scale-110"
                            :key="page.value"
                            :class="[page.isActive ? 'scale-110 bg-blue-500' : 'bg-blue-400' ]"
                            @click="paginationPageSelect(page.value)"
                        >
                            {{ page.value }}
                        </li>
                        <li 
                            class="bg-blue-400 py-1 px-3 text-white cursor-pointer rounded ease-in duration-200 font-bold mx-1 hover:bg-blue-500 hover:scale-110"
                            @click="paginationPageNext"    
                        >
                            <i class="bi bi-arrow-right"></i>
                        </li>
                        <li 
                            class="bg-blue-400 py-1 px-3 text-white cursor-pointer rounded ease-in duration-200 font-bold mx-1 hover:bg-blue-500 hover:scale-110"
                            @click="paginationPageLast"    
                        >
                            <i class="bi bi-arrow-bar-right">
                                
                            </i>
                        </li>
                    </ul>
                </div>
                <!--END PAGINATION -->
            </div>
            <!-- END CONTROLS-->

            <div class="my-5">
                <table class="table-auto w-full rounded overflow-hidden shadow">
                    <thead>
                        <tr class="bg-blue-500 text-white tracking-widest capitalize text-left font-bold">
                            <th class="p-3">#</th>
                            <th class="p-3 font-bold">name</th>
                            <th class="p-3">address</th>
                            <th class="p-3">created at</th>
                            <th class="p-3">actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-sm tracking-wider">
                        <tr class="border-y">
                            <td class="p-2" colspan="4"> 
                                
                            </td>
                            <td class="p-2">
                                <button 
                                    class="btn btn-green w-full"
                                    @click="modalCreateActive=true"
                                >
                                    <i class="bi bi-plus text-xl"></i>
                                </button>
                            </td>
                        </tr>
                        <tr 
                            class="border-y-2"
                            v-for="(item, index) in items.data.items" 
                            :key="item.slug"
                        >
                            <td class="p-2"> 
                                {{ (index + 1) + (paginationInfo.perPage * (paginationInfo.currentPage - 1)) }}
                            </td>
                            <td class="p-2">
                                {{ item.name }}
                            </td>
                            <td class="p-2">
                                {{ item.address }}
                            </td>
                            <td class="p-2">
                                {{ item.createdAt }}
                            </td>
                            <td class="grid grid-cols-2 gap-2 p-2">
                                <button class="btn btn-blue"
                                    @click="setupFormUpdate(item)"
                                >
                                    <i class="bi bi-pen-fill text-xl"></i>
                                </button>
                                <button class="btn btn-red">
                                    <i class="bi bi-trash-fill text-xl"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <app-modal
                v-show="modalCreateActive"
                @close-modal="modalCreateActive=false"
            >
                <template #header>
                    Add Hotel 
                </template>
                <template #default>

                </template>
            </app-modal>


            <app-modal
                v-show="modalUpdateActive"
                @close-modal="modalUpdateActive=false"
            >
                <template #header>
                    Update Hotel
                </template>
                <template #default>
                    {{ formUpdate.data }}
                </template>
            </app-modal>
		</div>
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
        },
        totalPages() 
        {
            return Math.ceil(this.paginationInfo.totalItems / this.paginationInfo.perPage);
        },
        paginationItems() 
        {
            const range             = [];
            const maxVisibleButtons = 5;
            const totalPages        = this.totalPages;
            const currentPage       = this.paginationInfo.currentPage; 

            for (
                let i = 1;
                i <= Math.min(maxVisibleButtons, totalPages);
                i++
            )
            {
                const increase = currentPage + 1 > maxVisibleButtons ? currentPage - maxVisibleButtons : 0; 

                range.push(
                    {
                        value     : i + increase,
                        name      : i + increase,
                        isActive  : i + increase === currentPage
                    }
                );

            } 
            return range;
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
            ],
            sortDirections : 
            [
                {
                    key  : 'desc',
                    value: 'desc',
                    label: 'DESC'
                }, 
                {
                    key  : 'asc',
                    value: 'desc',
                    label: 'ASC'
                }, 
            ],
            pageOptions:
            [
                {
                    key  : 1,
                    value: 10,
                    label: "10 Items"
                }, 
                {
                    key  : 2,
                    value: 25,
                    label: "25 Items"
                },
                {                    
                    key  : 3,
                    value: 50,
                    label: "50 Items"
                },
                {                     
                    key   : 4,
                    value: 100,
                    label: "100 Items" 
                }
            ],
            sortBy       : null,
            sortDesc     : false,
            sortDirection: null,
            filter       : null,
            paginationInfo : 
            {
                perPage    : null,
                currentPage: null,
                totalItems : null, 
                totalPages : null,
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
                    'search'       : this.filter                        ?? null,
                    'sizePerPage'  : this.paginationInfo.perPage        ?? 10,
                    'showPage'     : this.paginationInfo.currentPage    ?? 1,
                    'sortByColumn' : this.sortBy                        ?? null, 
                    'sortDirection': this.sortDirection                 ?? 'asc'
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
            this.modalUpdateActive       = true;     
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
        ), 
        /* PAGINATION CONTROLS */
        paginationPageFirst: debounce (
            function() 
            {
                this.paginationInfo.currentPage = 1; 

                this.onPageChange(); 
            }, 
            250
        ), 
        paginationPagePrevious: debounce (
            function() 
            {
                if (this.paginationInfo.currentPage > 1)
                {
                    this.paginationInfo.currentPage-- ; 
                }

                this.onPageChange(); 
            }, 
            250
        ),
        paginationPageSelect: debounce (
            function(value) 
            {
                this.paginationInfo.currentPage = value; 

                this.onPageChange(); 
            }, 
            250
        ),
        paginationPageNext: debounce (
            function() 
            {
                if (this.paginationInfo.currentPage < this.totalPages)
                {
                    this.paginationInfo.currentPage++ ; 
                }

                this.onPageChange(); 
            }, 
            250
        ),
        paginationPageLast: debounce (
            function() 
            {
                this.paginationInfo.currentPage =  this.totalPages; 

                this.onPageChange(); 
            }, 
            250
        )
        /* END PAGINATION CONTROLS */
    },
    mounted: async function () 
    {
        await this.fetchHotels({ requestData: null });

        this.paginationInfo.currentPage = this.items.data.pagination.current;
        this.paginationInfo.perPage     = this.items.data.pagination.size;
        this.paginationInfo.totalItems  = this.items.data.pagination.total;

        this.paginationInfo.totalPages  = Math.ceil(this.items.data.pagination.total / this.items.data.pagination.size);
    }, 
    watch:
    {
        filter: function (newValue, oldValue)
        {
            this.onPageChange();
        }, 
        modalCreateActive : function(newvalue, oldValue)
        {
            
        }
    }
};

</script>