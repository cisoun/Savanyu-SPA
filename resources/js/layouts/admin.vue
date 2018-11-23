<template>
  <div class="main-layout">
    <navbar/>

    <div class="container mt-4">
      <child/>
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/admin/Navbar'

export default {
  name: 'AdminLayout',

  components: {
    Navbar
  }
}
</script>
