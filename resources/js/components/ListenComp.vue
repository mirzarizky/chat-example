<template>

</template>

<script>
    export default {
        name: 'listen-comp',
        props: ['convoId'],
        mounted() {
            console.log('im mounted');
            Echo.channel('laravel_database_mc-chat-conversation.'.this.convoId)
                .listen('Musonza\\Chat\\Eventing\\MessageWasSent', (e) => {
                    console.log(e)
                });
        }
    }
</script>
