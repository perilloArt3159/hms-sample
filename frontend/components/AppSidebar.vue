<template>
    <div 
        id="sidebar"
        class="shadow-lg"
        :class="
        {
            active : isActive   
        }"
    >
        <div class="p-4">
            <div 
                v-if="isActive"
                class="flex justify-around align-items-center"
            >
                <span class="shrink text-md tracking-wider text-center">
                    Hotel Management System
                </span>    
                <span 
                    class="
                        text-lg
                        cursor-pointer  
                        ease-in duration-200
                        hover:scale-110 
                        hover:text-blue-400
                    "
                    @click="toggleIsActive"
                >
                    <i class="bi bi-x-circle">

                    </i>
                </span>
            </div>
            <div 
                v-else
                class="flex justify-around align-items-center"
            >
                <span 
                    class="
                        text-3xl
                        cursor-pointer  
                        ease-in duration-200
                        hover:scale-125 
                        hover:text-blue-400
                    "
                    @click="toggleIsActive"
                >
                    <i class="bi bi-list">

                    </i>
                </span>
            </div>
        </div>
        <div>
            <nav>
                <ul>

                </ul>
            </nav>
        </div>
    </div>
</template>

<style scoped lang="scss">

#sidebar 
{
    height          : 100vh;
    background-color: #fff;
    width           : 60px;
    position        : fixed; 
    top             : 0; 
    left            : 0;
    overflow-y      : auto;
    overflow-x      : hidden;
    transition      : all 0.5s ease; 
    z-index         : 1; 
    
    &.active 
    {
        width : 240px; 

        .sidebar-item span 
        {
            opacity  : 1;
            height: 100%;
        }
    }

    .sidebar-item 
    {
        color          : white;
        font-weight    : bold;
        padding        : 11px 14px;
        display        : flex;
        align-items    : center;
        text-decoration: none;
        transition     : all 0.4s linear;

        span 
        {
            height     : 0;
            opacity    : 0;
            margin-left: 10px;
            transition : all 0.2s linear;
        }

        &:hover 
        {
            background-color: #00000020;
        }

        &.active 
        {
            background-color: #2BACF8;
        }
    }

    a.nuxt-link-active 
    {
        font-weight: bold;
    }

    /* exact link will show the primary color for only the exact matching link */
    a.nuxt-link-exact-active 
    {
        background-color: #ffffff20;
    }
}

</style>

<script>

import 
{
    mapState, 
    mapActions, 
} 
from 'vuex';

export default
{
    name: 'NuxtAppSidebar', 
    computed : 
    {
        ...mapState(
            'sidebar', 
            [
                'items', 
                'isActive'
            ]
        )
    },
    methods: 
    {
        ...mapActions(
            'sidebar', 
            [
                'toggleIsActive'
            ]
        ),
        toggleStateActive: function ()
        {
            this.isActive = !this.isActive; 
        }      
    }
}

</script>