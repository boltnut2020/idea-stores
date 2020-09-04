<template>
  <div class="clock-parent mt-1">
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
  font-size: 2rem;
  position: relative;
}
</style>
