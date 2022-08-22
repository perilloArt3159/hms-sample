<template>
    <div class="wrapper">
        <app-toast/>
        <Nuxt />
    </div>
</template>

<style scoped lang="scss">

.wrapper 
{
    width  : 100%;
    height : 100%;
    padding: 1rem 0;
}

</style>

<script>
import AppToast from '../components/AppToast.vue'

export default
{
    components: { AppToast },
    //...
}

</script>