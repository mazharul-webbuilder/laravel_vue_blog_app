import {defineStore} from "pinia";

export const useLoaderStore = defineStore('loader', {
    state: () => ({
       loader: true
    }),
    getters: {
      getLoader(){
          return this.loader
      }
    },
    actions: {
        invertLoader(){
            this.loader = false
        }
    }
})