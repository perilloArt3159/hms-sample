<template>
    <div 
        class="toast shadow-lg p-5 rounded"
        :class="{active : isActive}"
    >
        <div class="grid grid-cols-5 grid-rows-2 gap-2 items-center">
            <i 
                class="bi bi-info-circle text-2xl text-blue-400 text-center"
            >

            </i>
            <div class="col-span-4 tracking-wide font-bold">
                {{ content.title }}
            </div>
            <div class="col-start-2 col-span-4 text-sm text-gray-400 tracking-wide">
                {{ content.message }}
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss"> 

.toast 
{
    position        : fixed;
    width           : 350px;
    top             : 20px; 
    right           : 20px;
    background-color: white;
    z-index         : 2;
    transform       : scale(0);
    transition      : all 0.4s ease;

    &.active 
    {
        transform : scale(1);
    }
}

</style>

<script>

import 
{
    mapState, 
} 
from 'vuex'; 

export default 
{
    computed : 
    {
        ...mapState(
            'toast', 
            [
                'isActive', 
                'content'
            ]
        )
    }, 
};

</script>