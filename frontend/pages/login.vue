<template>
    <div 
        id="formCard" 
        class="bg-white rounded shadow p-4 mx-auto"
    >
        <div class="border-b pb-2">
            <h1 class="tracking-wider font-bold uppercase text-slate-300 text-2xl text-center">
                Login 
            </h1>
        </div>

        <form 
            @submit.stop.prevent="submitLogin"
        >
            <div class="my-2">
                <div class="flex flex-col my-3">
                    <label 
                        for="inputEmail"
                        class="capitalize font-bold tracking-wider text-gray-400"
                    >
                        Email 
                    </label>
                    <div class="mt-1">
                        <input 
                            v-model="form.data.email"
                            id="inputEmail"
                            type="email"
                            class="form-control form-control-input w-full"
                            placeholder="Enter Name"
                            required
                        >
                        <small 
                            class="text-red-400 my-2"
                            v-if="form.state.email == false"
                        >
                            This field is required.
                        </small>
                    </div>
                </div>
                <div class="flex flex-col my-3">
                    <label 
                        for="inputPassword"
                        class="capitalize font-bold tracking-wider text-gray-400"
                    >
                        password 
                    </label>
                    <div class="mt-1">
                        <input 
                            v-model="form.data.password"
                            id="inputpassword"
                            type="password"
                            class="form-control form-control-input w-full"
                            placeholder="Enter Name"
                            required
                        >
                        <small 
                            class="text-red-400 my-2"
                            v-if="form.state.password == false"
                        >
                            This field is required.
                        </small>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button 
                    type="submit"
                    class="btn btn-blue p-2 w-full"
                >
                    Login Page
                </button>
            </div>
        </form>
    </div>
</template>

<style scoped lang="scss">

#formCard 
{
    width : 450px; 
}

</style>

<script>

import { debounce } from 'lodash'; 
import { mapActions } from 'vuex'; 

export default
{
    middleware : 'auth', 
    auth       : 'guest', 
    layout: "auth",
    data : () => (
        {
            form: 
            {
                data :     
                {
                    email   : 'admin@test.com',
                    password: 'admin'
                }, 
                state : 
                {
                    email   : null,
                    password: null
                }
            }
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

        checkIfFormValid() 
        {
            const valid = this.$refs.form.checkValidity();

            this.form.state.email    = this.form.data.email    == null || this.form.data.email   == '' ? false : true;
            this.form.state.password = this.form.data.password == null || this.form.data.password == '' ? false : true;

            return valid; 
        }, 
        submitLogin : debounce(
            function () 
            {
                if (this.checkIfFormValid())
                {
                    this.$auth.loginWith(
                        'laravelSanctum', 
                        {
                            data :
                            {
                                email    : this.form.email, 
                                password : this.form.password
                            }
                        }
                    )
                    .then(() => this.$router.push('/'))
                    .catch(
                        error => 
                        {
                            if (error.response.status !== 422)  
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
                            else 
                            {
                                this.showToast(
                                    {
                                        content : 
                                        {
                                            title   : "Error!",
                                            message : "Please Check the Form!"
                                        }, 
                                        settings : 
                                        {
                                            timeout : 5000
                                        } 
                                    }
                                );
                            }
                        }
                    )
                    ;   
                }
                else 
                {
                    this.showToast(
                        {
                            content : 
                            {
                                title   : "Error!",
                                message : "Please Check the Form!"
                            }, 
                            settings : 
                            {
                                timeout : 5000
                            } 
                        }
                    );
                }
            }, 
            250
        )
    }
}

</script>
