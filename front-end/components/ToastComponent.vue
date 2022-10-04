<template>
  <div></div>
</template>
<script>
import { mapState } from 'vuex'
export default {
  name: 'ToastComponent',
  computed: {
    ...mapState(['notifications']),
    isNotEmpty() {
      return Object.values(this.notifications).length
    },
  },
  watch: {
    notifications: {
      immediate: true,
      deep: true,
      handler(data) {
        if (this.isNotEmpty) {
          this.makeToast(data)
        }
      },
    },
  },
  methods: {
    makeToast(data) {
      this.$bvToast.toast(`${data.body}`, {
        autoHideDelay: 9000,
        title: data.title,
        solid: true,
        appendToast: true,
        variant: data.variant
      })
        this.$store.commit('emptyNotification')
    },
  },
}
</script>
