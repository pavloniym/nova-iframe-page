<template>
    <iframe v-bind="iframeOptions" :style="iframeStyles" class="nova-iframe-page"/>
</template>

<script setup>

    // Vue
    import {computed} from 'vue'

    // Props
    const props = defineProps({
        src: {type: String, default: null},
        height: {type: String, default: null},
        noScroll: {type: Boolean, default: false},
        noTopPadding: {type: Boolean, default: false},
        iframeStyles: {type: Object, default: null},
        iframeOptions: {type: Object, default: null},
        noFrameBorder: {type: Boolean, default: false},
        withBorderRadius: {type: Boolean, default: false},
    })

    // Computed
    // Get iframe options
    const iframeOptions = computed(() => {
        return {
            src: props?.src,
            width: '100%',
            scrolling: props?.noScroll ? 'no' : 'yes',
            frameborder: props?.noFrameBorder ? 'no' : 'yes',
            ...props?.iframeOptions,
        }
    })

    // Computed
    // Get iframe styles
    const iframeStyles = computed(() => {
        return {
            height: props?.height,
            marginTop: props?.noTopPadding ? '-32px' : null,
            borderRadius: props?.withBorderRadius ? '12px' : null,
            ...props?.iframeStyles,
        }
    })

</script>
