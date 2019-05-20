<template>
  <div class="row">
    <div class="col-md-3 mb-3">
      <card :title="$t('management.title')" class="card-menu">
        <ul class="nav flex-column nav-pills">
          <li v-for="tab in tabs" :key="tab.route" class="nav-item">
            <router-link :to="{ name: tab.route }" class="nav-link" active-class="active">
              <fa :icon="tab.icon" size="xs" fixed-width/>
              {{ tab.name }}
            </router-link>
          </li>
        </ul>
      </card>
    </div>

    <div class="col-md-9">
      <transition name="fade" mode="out-in">
        <router-view/>
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  layout: 'admin',
  middleware: 'auth',

  computed: {
    tabs () {
      return [
        {
          icon: 'home',
          name: this.$t('welcome'),
          route: 'admin.management.welcome'
        },
        {
          icon: 'palette',
          name: this.$t('artworks'),
          route: 'admin.management.artworks'
        },
        {
          icon: 'user',
          name: this.$t('biography'),
          route: 'admin.management.biography'
        }
      ]
    }
  }
}
</script>
