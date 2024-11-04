<template>
    <div class="toggle-container">
      <label class="toggle-switch">
            <input type="checkbox" v-model="featureEnabled" @change="toggleFeature" />
            <span class="slider"></span>
    </label>
    <span class="label-text">Manually Manage Slider (Optional)</span>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

// Create a reactive variable for feature enabled status
const featureEnabled = ref(false);
const emit = defineEmits(['update:featureEnabled']);

// Fetch the current feature status when the component mounts
const fetchFeatureStatus = async () => {
    try {
        const response = await axios.get('/settings'); 
        featureEnabled.value = response.data.feature_enabled === 1;
        emit('update:featureEnabled', featureEnabled.value);

    } catch (error) {
        console.error('Error fetching feature status:', error);
    }
};

// Toggle the feature status
const toggleFeature = async () => {
    try {
        await axios.post('/settings/toggle-feature', {
            feature_enabled: featureEnabled.value ? 1 : 0,
        });
        emit('update:featureEnabled', featureEnabled.value);
    } catch (error) {
        console.error('Error toggling feature:', error);
    }
};

// Use onMounted lifecycle hook to fetch the status
onMounted(fetchFeatureStatus);
</script>
<style scoped>
.toggle-container {
    padding: 3rem;
  display: flex;
  gap: 10px;
}

.toggle-switch {
    
  position: relative;
  width: 50px;
  height: 24px;
}

.toggle-switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
  border-radius: 34px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #4caf50;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

.label-text {
  font-size: 16px;
  color: #ffffff;
}
</style>
