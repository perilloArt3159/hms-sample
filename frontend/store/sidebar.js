export default 
{
    state: () => 
    (
        {
            isActive: true, 
            items   : 
        
            [
                {
                    name     : 'home',
                    to       : '/',
                    icon     : 'bi bi-house-door',
                    title    : 'Home',
                    component: 'hotels'
                },
                {
                    name     : 'about-us',
                    icon     : 'bi bi-info-circle',
                    to       : '/about-us',
                    title    : 'About Us',
                    component: 'about-us'
                },
                {
                    name     : 'hotels',
                    icon     : 'bi bi-building',
                    to       : '/hotels',
                    title    : 'Hotels',
                    component: 'hotels'
                },
            ]
        }
    ), 
    getters: 
    {
        //...
    }, 
    actions: 
    {
        toggleIsActive({commit, dispatch})
        {
            commit('TOGGLE_IS_ACTIVE'); 
        }
    }, 
    mutations: 
    {
        TOGGLE_IS_ACTIVE(state)
        {
            state.isActive = !state.isActive;
        }
    }
}