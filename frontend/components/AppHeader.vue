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
                    >
                        <i class="bi bi-person-circle text-2xl">

                        </i>
                        <span class="ml-2" style="width:150px">
                            Guest
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
                color: #0066ff ;
                transform: scale(1.01);
            }
        }
    }

</style>

<script>

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
        toggleDarkMode()  
        {
            this.isDarkModeActive = !this.isDarkModeActive;
        }
    }
}

</script>