<template>
    <div id="content">
        <app-sidebar/>
        <div 
            id="main"
        >
            <app-header/>
            <main>
                <Nuxt />
            </main>
            <app-footer/>
        </div>
    </div>
</template>

<style scoped lang="scss">

#content 
{
    position      : relative; 
    display       : flex;
    flex-direction: row;

    #main 
    {
        min-height     : 100vh;
        display        : flex;
        flex-direction : column;
        position       : absolute; 
        width          : calc(100% - 60px); 
        height         : 100%; 
        left           : 60px;
        padding        : 0 2.5rem; 
        transition     : all 0.5s ease; 
        overflow-y     : auto;
    
        footer
        {
            margin-top : auto;
        }
    }
    
    #sidebar.active ~ #main 
    {
        width: calc(100% - 240px);
        left: 240px;
    }
}
</style>

<script lang="ts">

import Vue from 'vue'

export default Vue.extend(
	{
        //...
	}
)
</script>