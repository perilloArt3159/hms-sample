<template>
    <header class="rounded bg-white shadow-lg my-2">
        <div class="px-4 py-2">
            <nav class="flex items-center">
                
                <!-- LEFT SIDE-->
                <ul class="flex text-gray-400">
                    <li class="">
                        <a 
                            href="https://github.com/perilloArt3159/hms-sample" 
                            target="_blank"
                            class="flex items-center font-bold  cursor-pointer"
                        >
                            <i class="bi bi-github text-2xl">
                                
                            </i>
                        <span class="ml-2">
                            Source Code
                        </span>
                        </a>
                    </li>
                </ul>

                <!-- RIGHT SIDE-->
                <ul class="ml-auto flex text-gray-400">
                    <li 
                        class="mr-3 cursor-pointer"
                        @click="toggleDarkMode"
                    >
                        <i 
                            v-if="isDarkModeActive" 
                            class="bi bi-moon-stars text-2xl"
                        >

                        </i>
                        <i 
                            v-else 
                            class="bi bi-brightness-high text-2xl"
                        >

                        </i>
                    </li>
                    <li 
                        class="mr-3 cursor-pointer"
                    >
                        <i 
                            class="bi bi-bell text-2xl"
                        >

                        </i>
                    </li>
                    <li 
                        class="flex items-center font-bold  cursor-pointer border-l pl-3"
                        @click="logout"
                    >
                        <i class="bi bi-power text-2xl">

                        </i>
                        <span class="ml-2" style="width:150px">
                            Logout
                        </span>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<style scoped lang="scss">

    ul
    {
        li 
        {
            transition : all 0.2s ease-in;

            &:hover 
            {
                color    : rgb(59 130 246);
                transform: scale(1.01);
            }
        }
    }

</style>

<script>

import { debounce } from 'lodash'; 
import { mapActions } from 'vuex'; 

export default
{
    name: 'NuxtAppHeader',
    data: () => (
        {
            isDarkModeActive : false, 
        }
    ), 
    methods : 
    {
        ...mapActions(
            'toast', 
            [
                'showToast'
            ]
        ),

        toggleDarkMode()  
        {
            this.isDarkModeActive = !this.isDarkModeActive;
        }, 
        logout : debounce (
            function () 
            {
                this.$auth.logout()
                    .then(() => 
                        {
                            this.showToast(
                                {
                                    content : 
                                    {
                                        title   : "Success!",
                                        message : "Logout Successful!"
                                    }, 
                                    settings : 
                                    {
                                        timeout : 5000
                                    } 
                                }
                            );
                        }
                    )
                    .catch(
                        error => 
                        {
                            this.showToast(
                                {
                                    content : 
                                    {
                                        title   : "Error!",
                                        message : "Something Went Wrong!"
                                    }, 
                                    settings : 
                                    {
                                        timeout : 5000
                                    } 
                                }
                            );
                        }
                    )
            }, 
            250
        )
    }
}

</script>