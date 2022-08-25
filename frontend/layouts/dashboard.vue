<template>
    <div id="content">
        <app-toast/>
        <the-sidebar/>
        <div 
            id="main"
        >
            <the-header/>
            <main>
                <h2 
                    class="font-bold text-blue-400 text-3xl my-3 tracking-wider capitalize"
                >
                    <portal-target name="title">

                    </portal-target>
                </h2>

                <hr class="hr" />

                <div 
                    class="my-5"
                >
                    <Nuxt />
                </div>
            </main>
            <the-footer/>
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

<script>

export default
{
    //...
}

</script>