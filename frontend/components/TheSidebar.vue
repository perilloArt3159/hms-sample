<template>
    <div 
        id="sidebar"
        class="shadow-lg"
        :class="
        {
            active : isActive   
        }"
    >
        <div class="px-4 py-2 border-b">
            <div 
                v-if="isActive"
                class="flex justify-around items-center"
            >
                <span class="text-md font-bold tracking-wider text-center">
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
                class="flex justify-around items-center"
            >
                <span 
                    class="
                        text-4xl
                        cursor-pointer  
                        ease-in duration-200
                        hover:scale-110 
                        hover:text-blue-400
                    "
                    @click="toggleIsActive"
                >
                    <i class="bi bi-list">

                    </i>
                </span>
            </div>
        </div>
        <div class="my-2">
            <nav>
                <ul>
                    <li 
                        v-for="link in items" 
                        :key="link.name"
                        class="px-1"
                    >
                        <nuxt-link
                            :to="link.to"
                            class="sidebar-item rounded text-center my-1"
                        >
            
                        <i :class="[link.icon, 'text-2xl']">

                        </i>
            
                        <span>
                            {{ link.title }}
                        </span>
                    </nuxt-link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<style scoped lang="scss">

#sidebar 
{
    height          : 100vh;
    background-color : #222; 
    color           : white; 
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
        background-color: #fff;
        color           : grey;

        .sidebar-item 
        {
            &:hover 
            {
                background-color: #00000020;
                transform       : scale(1.05);
            }

            span 
            {
                opacity     : 1;
                height      : 100%;
                color       : grey;
            }

            i 
            {
                color : grey;
            }
        }
    }

    .sidebar-item 
    {
        color          : grey;
        font-weight    : bold;
        padding        : 11px 14px;
        display        : flex;
        align-items    : center;
        text-decoration: none;
        transition     : all 0.4s ease-in;

        span 
        {
            height     : 0;
            opacity    : 0;
            margin-left: 1rem;
            transition : all 0.2s linear;
        }

        &:hover 
        {
            background-color: #ffffff20;
            transform       : scale(1.05);
        }


        &.nuxt-link-exact-active 
        {
            background: linear-gradient(to left, #00ffff 0%, #0066ff 100%);

            i, 
            span
            {
                color : white;
            } 
        }
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