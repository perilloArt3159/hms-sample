<template>
    <div 
        class="modal-overlay active"
    >
        <div class="modal shadow">
            <div class="modal-header text-xl">
                <div class="grid grid-cols-8 items-center">
                    <div class="col-span-7">
                        <slot name="header"/>
                    </div>
                    <div 
                        class="text-center font-bold ease-in duration-200 hover:scale-125 cursor-pointer"
                        @click="$emit('close-modal')"
                    >
                        <i class="bi bi-x-circle">

                        </i>
                    </div>
                </div>
            </div>
            <div class="modal-content">
                <slot />
            </div>
            <div class="modal-footer">
                <div class="flex align-items justify-end">
                    <slot name="footer">
                        <button 
                            class="btn btn-blue p-2 mr-2"
                            @click="$emit('close-modal')"
                        >
                            Cancel
                        </button>
                        <button 
                            class="btn btn-blue p-2"
                            @click="$emit('submit-modal')"
                        >
                            Submit
                        </button>
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">

.modal-overlay
{
    width    : 100vw; 
    height   : 100vh; 
    position : fixed; 
    top      : 0; 
    left     : 0;
    background-color : #00000080;
    z-index  : 1;

    .modal 
    {
        overflow         : hidden;
        margin           : 2rem auto;
        width            : 550px; 
        background-color : white; 
        border-radius    : 4px;

        .modal-header, 
        .modal-content, 
        .modal-footer
        {
            padding          : 0.8rem 1.2rem;
        }

        .modal-header
        {
            background-color : rgb(59 130 246);
            color            : white; 
            font-weight      : bold;
            letter-spacing   : 2px; 
            
        }

        .modal-content 
        {
            color            : grey;
        }

        .modal-footer
        {
            border-top       : 1px dotted grey;
        }
    }
} 

</style>

<script>

export default 
{
    data  : () => (
        {

        }
    )
}

</script>