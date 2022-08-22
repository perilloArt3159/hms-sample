const endpoint = 'hotels'; 

export default 
{
    state: () => 
    (
        {
            items: null
        }
    ), 
    getters: 
    {
        //...
    }, 
    actions: 
    {
        async fetchHotels({ commit, dispatch }, requestData) 
        { 
            const response = await this.$axios.get(
                `${endpoint}`, 
                {
                    params: 
                    {
                        'search'       : requestData.search,
                        'sizePerPage'  : requestData.sizePerPage,
                        'showPage'     : requestData.showPage,
                        'sortByColumn' : requestData.sortByColumn,
                        'sortDirection': requestData.sortDirection
                    }
                }
            );
            
            commit('SET_ITEMS', response.data);
    
            return response.data; 
        }, 
        async createHotel({ commit, dispatch }, requestData) 
        {
            await this.$axios.post(
                `${endpoint}/create`,
                {
                    'name'   : requestData.name,
                    'address': requestData.address,
                }
            );
        },
        async fetchHotel(slug) 
        {
            const hotel = await this.$axios.get(`${endpoint}/${slug}/show`);
    
            return hotel;
        },
        async updateHotel({ commit, dispatch }, { requestData, slug }) 
        {
            await this.$axios.put(
                `${endpoint}/${slug}/update`, 
                {
                    'name'   : requestData.name,
                    'address': requestData.address,
                }
            ); 
        },
        async deleteHotel({ commit, dispatch }, slug)
        {
            await this.$axios.delete(`${endpoint}/${slug}/destroy`);
        }
    }, 
    mutations: 
    {
        SET_ITEMS(state, items)
        {
            state.items = items;
        },
    }
};