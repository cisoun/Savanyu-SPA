<template>
  <div class="sidebar">
    <router-link :to="{ name: 'artworks' }" class="nav-link menu-primary" active-class="active">{{ $t('artworks') }}</router-link>
    <ul>
      <li v-for="tab in tabs" :key="tab" class="nav-item">
        <router-link :to="{ name: `artworks.${tab}` }" class="nav-link" active-class="active">
          {{ $t(tab) }}</a>
        </router-link>
      </li>
    </ul>
    <router-link :to="{ name: 'bio' }" class="nav-link menu-primary" active-class="active">{{ $t('bio') }}</router-link>
    <div class="icons">
      <a href="instagram.com/victorsavanyusanchez/" class="icon icon-instagram">{{ $t('instagram') }}</a>
      <a href="mail://mail@savanyu.ch" class="icon icon-contact">{{ $t('contact') }}</a>
    </div>
    <a class="menu-primary" href="#">Victor Savanyu</a>
  </div>
</template>

<script>
export default {
  name: 'Sidebar',

  computed: {
    tabs () {
      return [
        'painting',
        'photography',
        'sculpture',
        'video'
      ];
    }
  }
}
</script>

<style scoped>
a {
  display: block
}

li {
  list-style: none;
}

li a {
  line-height: 1.2rem;
  padding: unset;
}

.menu-primary {
  font-weight: bold;
  text-transform: uppercase;
}

.icons {
  margin-bottom: 50px;
  margin-top: 340px;
}

.icon {
    background-repeat: no-repeat;
    background-size: contain;
    font-size: 0;
    height: 35px;
    margin: 5px 0;
    width: 35px;
}

.icon-instagram {
    background-image: url('~/img/instagram.jpg');
}

.icon-contact {
    background-image: url('~/img/contact.jpg');
}
</style>
