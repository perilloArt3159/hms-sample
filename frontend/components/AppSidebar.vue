<template>
    <div id="sidebar" :class="{ 'active' : isActive }">
        <nav>
            <!-- SIDEBAR TITLE-->
            <div class="p-3 border-bottom border-white">
                <div v-if="isActive" class="d-flex justify-content-center align-items-center text-center">
                    <div class="">
                        <span class="font-weight-bolder">
                            Hotel Management System
                        </span>
                    </div>
                    <div class="">
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            width="16" 
                            height="16" 
                            fill="currentColor"
                            class="bi bi-x cursor-pointer" 
                            viewBox="0 0 16 16"
                            @click="this.toggleStateActive" 
                        >
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </div>
                </div>
                <div v-else class="d-flex justify-content-center">
                    <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        width="32" 
                        height="32" 
                        fill="currentColor"
                        class="bi bi-list cursor-pointer" 
                        viewBox="0 0 16 16"
                        @click="this.toggleStateActive" 
                    >
                        <path fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </div>
            </div>
    
            <!-- SIDEBAR ITEMS-->
            <nav class="mb-3 border-top">
                <b-nav vertical>                 
                    <nuxt-link
                        :to="link.to"
                        class="sidebar-item"
                        v-for="link in links" 
                        :key="link.name"
                    >
                        <i :class="[link.icon, 'h4']">

                        </i>
                        <span>
                            {{ link.title }}
                        </span>
                    </nuxt-link>
                </b-nav>
            </nav>
        </nav>
    </div>
</template>

<style scoped lang="scss">

#sidebar 
{
    height          : 100vh;
    background-image: linear-gradient(to top left, #66ffff 0%, #000099 100%);
    color           : #fff;
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
            display : block; 
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
            display    : none;
            margin-left: 10px;
        }

        &:hover {
            background-color: #00000020;
        }

        &.active {
            background-color: #2BACF8;
        }
    }
}

</style>

<script>

export default
{
    name: 'NuxtAppSidebar', 
    data: () => (
        {
            isActive: true, 
            links: 
            [
                {
                    name : 'home',
                    to   : '/',
                    icon : 'bi bi-house-door',
                    title: 'Home',
                    component: 'hotels'
                }, 
                {
                    name     : 'about-us',
                    icon     : 'bi bi-info',
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
    methods: 
    {
        toggleStateActive: function ()
        {
            this.isActive = !this.isActive; 
        }      
    }
}

</script>