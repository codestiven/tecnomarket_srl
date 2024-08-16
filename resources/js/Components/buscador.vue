<template>
    <div class="buscador">
        <div class="input-container">
            <input type="text" v-model="busqueda" @focus="showSuggestions = true" @blur="hideSuggestions"
                @input="onInput" placeholder="Buscar..." class="input-buscador" />
            <button @click="buscarProducto">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-icon">
                    <path
                        d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                </svg>
            </button>
        </div>
        <ul v-if="showSuggestions && suggestions.length" class="suggestions-list">
            <li v-for="suggestion in suggestions" :key="suggestion.value" @click="onSelect(suggestion)">
                {{ suggestion.value }}
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            busqueda: '',
            suggestions: [],
            showSuggestions: false,
        };
    },
    methods: {
        onInput(event) {
            this.busqueda = event.target.value;
            this.fetchSuggestions(this.busqueda);
        },
        async fetchSuggestions(query) {
            try {
                const response = await axios.get('/api/suggestions', {
                    params: { query }
                });
                this.suggestions = response.data.suggestions;
            } catch (error) {
                console.error('Error fetching suggestions:', error);
                this.suggestions = [];
            }
        },
        onSelect(suggestion) {
            this.busqueda = suggestion.value;
            this.buscarProducto();
            this.showSuggestions = false;
        },
        buscarProducto() {
            if (this.busqueda) {
                this.$inertia.visit(`/Productos/search/${this.busqueda}`);
            } else {
                this.$inertia.visit('/Productos/search/*');
            }
        },
        hideSuggestions() {
            setTimeout(() => {
                this.showSuggestions = false;
            }, 200);
        },
    },
};
</script>

<style scoped>
* {
    z-index: 10;
}

.buscador {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

.input-container {
    display: flex;
    align-items: center;
    width: 90%;
    position: relative;
}

.input-buscador {
    flex: 1;
    border-radius: 5px 0 0 5px;
    border: 1px solid #ccc;
    outline: none;
    height: 40px;
}

button {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--complementario-color);
    width: 50px;
    padding: 0 15px;
    border-radius: 0 5px 5px 0;
    color: #fff;
    height: 40px;
}

.suggestions-list {
    list-style: none;
    padding: 0;
    margin: 10px 0 0;
    /* Ajusta el margen superior para colocar la lista más abajo */
    position: absolute;
    background: #fff;
    border: 1px solid #ddd;
    width: 90%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transform: translate(0, 40px);
}

.suggestions-list li {
    padding: 10px;
    cursor: pointer;
}

.suggestions-list li:hover {
    background: #eee;
}

.svg-icon {
    width: 25px;
    height: 25px;
    fill: #fff;
}
</style>
