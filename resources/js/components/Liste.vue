<template>
  <div>
    <div class="input-container">
      <input v-model="longUrl" type="text" placeholder="Enter a long URL">
      <button @click="shortenUrl">Shorten</button>
    </div>

    <div class="error-container" v-if="error">
      <ul>
        <li v-for="(errorArray, index) in error" :key="index" class="error-item">
          {{ errorArray[0] }}
        </li>
      </ul>
    </div>

    <div class="links-container">
      <div class="link-item" v-for="link in links" :key="link.id">
        <div class="url-info">
          <div class="short-url">{{ link.short_url }}</div>
          <div class="long-url">{{ link.long_url }}</div>
          <div class="clicks"><i class="fas fa-eye"></i> {{ link.clicks }}</div>
          <div class="created-at"><i class="fas fa-calendar"></i> {{ link.created_at }}</div>
        </div>
        <div class="link-actions">
          <button @click="copyToClipboard(link.short_url)">Copy</button>
          <a :href="link.long_url" target="_blank">Visit</a>
          <button @click="deleteLink(link.id)">Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

const user_id = inject('user_id');

export default {
  setup() {
    const user_id = ref(user_id); // Replace with actual user ID
    const longUrl = ref('');
    const error = ref(null);
    const links = ref([]);

    const shortenUrl = async () => {
      try {
        const response = await axios.post('/api/add', {
          long_url: longUrl.value,
          user_id: user_id.value,
        });
        longUrl.value = '';
        error.value = null;
        fetchData();
      } catch (error) {
        error.value = error.response.data.errors;
      }
    };

    const fetchData = async () => {
      try {
        const response = await axios.get(`/api/urls/${user_id.value}`);
        links.value = response.data;
      } catch (error) {
        console.error(error);
      }
    };

    const deleteLink = async (linkId) => {
      try {
        await axios.delete(`/api/urls/delete/${linkId}`);
        links.value = links.value.filter(link => link.id !== linkId);
      } catch (error) {
        console.error(error);
      }
    };

    const copyToClipboard = (text) => {
      navigator.clipboard.writeText(text);
      alert('Copied to clipboard!');
    };

    onMounted(() => {
      fetchData();
    });

    return {
      longUrl,
      error,
      links,
      shortenUrl,
      deleteLink,
      copyToClipboard,
    };
  },
};
</script>


<style>
.input-container {
  display: flex;
  margin-bottom: 1rem;
}

.input-container input {
  flex: 1;
  padding: 0.5rem;
}

.input-container button {
  margin-left: 0.5rem;
}

.error-container {
  margin-bottom: 1rem;
  color: red;
}

.links-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  grid-gap: 1rem;
}

.link-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f2f2f2;
  padding: 1rem;
}

.url-info {
  flex: 1;
}

.link-actions button {
  margin-right: 0.5rem;
}
</style>
