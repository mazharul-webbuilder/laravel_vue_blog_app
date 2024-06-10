import {defineStore} from "pinia";

export const useBlogStore = defineStore('blog', {
    state: () => ({
        blog:{
            title: '',
            content: ''
        }
    }),
    getters: {
        getBlog(){
            return this.blog
        }
    },
    actions: {
        setBlog(title, content){
            this.blog.title = title
            this.blog.content = content
        }
    }
})