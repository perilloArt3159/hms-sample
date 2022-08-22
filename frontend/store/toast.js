export default 
{
    state: () => 
    (
        {
            isActive: null,
            content : 
            {
                title   : 'Hello World', 
                message : 'Hello World',
            }, 
            settings : 
            {
                timeout :  5000, 
            }
        }
    ), 
    getters: 
    {
        //...
    }, 
    actions: 
    {
        showToast ({commit, dispatch }, { content, settings})
        { 
            commit('SET_IS_ACTIVE', true); 
            commit('SET_CONTENT', content); 

            setTimeout(
                function () 
                {
                    dispatch('closeToast')
                }, 
                settings.timeout
            )

        }, 
        closeToast ({commit, dispatch})
        {
            const content = { title : null, message : null };

            commit('SET_IS_ACTIVE', false); 
            commit('SET_CONTENT', content); 
        }
    }, 
    mutations: 
    {
        SET_IS_ACTIVE (state, payload)
        {
            state.isActive = payload; 
        },
        SET_CONTENT (state, payload)
        {
            state.content.title   = payload.title;
            state.content.message = payload.message;
        }
    }
};