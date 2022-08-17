import axios from "axios";

const endpoint = 'hotels'; 

export const state = () => (
    {
        hotels: []
    }
)

export const getters = 
{

}

export const actions = 
{
    async fetchHotels({ commit, dispatch }, requestData) 
    { 
        const hotels = await this.$axios.get(
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
        
        commit('addHotels', hotels);

        return hotels; 
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
    async updateHotel({ commit, dispatch }, requestData, slug) 
    {
        await this.$axios.put(
            `${endpoint}/${slug}/update`, 
            {
                'name'   : requestData.name,
                'address': requestData.address,
            }
        ); 
    },
    async deleteHotel({ commit, dispatch }, $slug)
    {
        await this.$axios.delete(`${endpoint}/${slug}/destroy`);
    }
}

export const mutations =
{
    addHotels(state, hotels)
    {
        state.hotels.push(
            { ...hotels }
        )
    },
};