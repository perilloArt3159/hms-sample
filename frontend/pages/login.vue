<template>
    <div 
        id="formCard" 
        class="bg-white rounded shadow p-4"
    >
        <div class="border-b">
            <h1 class="tracking-wider font-bold uppercase text-slate-300 text-2xl text-center">
                Login 
            </h1>
        </div>

        <div>

        </div>
        <div>
            <button 
                class="btn btn-blue"
                @click="submitLogin"
            >
                Login Page
            </button>
        </div>
    </div>
</template>

<style scoped lang="scss">

#formCard 
{
    width : 550px; 
    margin : 0 auto;
}

</style>

<script>

import { debounce } from 'lodash'; 

export default
{
    layout: "auth",
    data : () => (
        {
            formData : 
            {
                email   : 'admin@test.com',
                password: 'admin'
            }
        }
    ),
    methods :  
    {
        submitLogin : debounce(
            function () 
            {
                this.$auth.loginWith('laravelSanctum', 
                    {
                        data :
                        {
                            email    : this.formData.email, 
                            password : this.formData.password
                        }
                    }
                )
            }, 
            250
        )
    }
}

</script>
