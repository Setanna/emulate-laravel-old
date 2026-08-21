<template>
    <div class="input-wrapper">
        <input
            ref="input"
            v-model="inputValue"
            @input="resizeInput"
            type="text"
        />
    </div>
</template>

<script>
import { ref, onMounted, nextTick } from 'vue';

export default {
    name: 'AutoResizeInput',
    setup() {
        const inputValue = ref('');
        const inputRef = ref(null);

        const resizeInput = async () => {
            await nextTick();
            if (inputRef.value) {
                const context = document.createElement('canvas').getContext('2d');
                const font = window.getComputedStyle(inputRef.value).font;
                context.font = font;
                const width = context.measureText(inputValue.value).width;
                inputRef.value.style.width = `${width + 20}px`; // Adding some padding
            }
        };

        onMounted(() => {
            resizeInput();
        });

        return {
            inputValue,
            inputRef,
            resizeInput
        };
    }
};
</script>

<style>
.input-wrapper {
    display: inline-block;
}

input {
    padding: 4px;
    border: 1px solid #ccc;
    font-size: 16px;
    box-sizing: content-box; /* Ensure width calculation is based on content */
}
</style>
