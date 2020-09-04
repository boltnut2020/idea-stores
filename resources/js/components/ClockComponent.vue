<template>
  <div class="clock-parent">
    <vue-clock />
  </div>
</template>

<script>
import VueClock from '@dangvanthanh/vue-clock';

export default {
  components: { VueClock }
}
</script>

<style scoped>
.clock-parent >>> .clock {
	margin-bottom: 0px;
} 
.clock-parent >>> .clock__hours,
.clock-parent >>> .clock__minutes,
.clock-parent >>> .clock__seconds {
  font-size: 1.8rem;
  position: relative;
}
</style>
