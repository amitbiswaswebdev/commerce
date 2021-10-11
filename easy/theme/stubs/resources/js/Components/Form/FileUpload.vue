<template>
    <draggable
        class="flex flex-wrap"
        tag="div"
        :list="files"
        :group="{ name: 'g11' }"
        item-key="custom_id">
        <template #item="{ element }">
            <div class="flex-none w-1/4 mb-4">
                <div class="border-2 p-2 mx-2 border-gray-300 rounded-md shadow-sm">
                    <div class="w-full h-32 preview-image" :style="{ backgroundImage: 'url(' + element.preview_url + ')'}" />
                    <div class="flex justify-between items-center">
                        <div>
                            <p>{{ trimText(element.name, 15) }}</p>
                            <small class="text-xs">{{ parseFloat(element.size / 1024).toFixed(2) }} kb</small>
                        </div>
                        <i class="mdi mdi-delete-outline text-xl cursor-pointer" aria-hidden="true" @click="removeFile(element)"></i>
                    </div>
                </div>
            </div>
        </template>
        <template v-if="canShow" #footer>
            <div
                @dragenter="OnDragEnter"
                @dragleave="OnDragLeave"
                @dragover.prevent
                @drop="onDrop"
                class="flex-none w-1/4 mb-4">
                <div class="border-2 rounded-md shadow-sm mx-2"
                    :class="{ 'border-indigo-600': isDragging, 'border-gray-300': !isDragging }">
                    <label :for="id" class="cursor-pointer flex items-center justify-center h-48">
                        <div class="text-8xl">
                            <i class="mdi mdi-file-upload-outline" aria-hidden="true"></i>
                        </div>
                    </label>
                    <input
                    type="file"
                    :id="id"
                    class="hidden"
                    @change="onInputChange"
                    :accept="accept"
                    :multiple="multiple">
                </div>
            </div>
        </template>
    </draggable>
</template>

<script>
    import { defineComponent } from 'vue'
    import draggable from 'vuedraggable'
    export default defineComponent({
        components: {
            draggable
        },
        props: {
            id:{
                type: String,
                required: true,
            },
            previewUrls :{
                type: Array,
                required: false,
                default: [],
            },
            multiple: {
                type: Boolean,
                required: false,
                default: false,
            },
            accept: {
                type: String,
                required: false,
                default: "image/png, image/jpeg, image/jpg",
            },
            maxFileSize: {
                type: Number,
                required: false,
                default: 2048,
            }
        },
        data: () => ({
            isDragging: false,
            extensionArray: [],
            files: []
        }),
        watch: {
            files: {
                handler(val, oldVal) {
                     if (multiple) {
                        this.$emit('getFiles', val)
                    } else if (val.length) {
                        this.$emit('getFiles', val[0])
                    } else {
                        this.$emit('getFiles', null)
                    }
                },
                deep: true
            },
        },
        created() {
            if (this.previewUrls.length) {
                this.files = this.previewUrls
            }
            this.extensionArray = this.accept.replace(/\s/g,'').split(',');
        },
        computed:{
            canShow() {
                if (this.files.length === 0) {
                    return true;
                } else if (this.files.length > 0 && this.multiple ) {
                    return true;
                }
                return false;
            }
        },
        methods: {
            trimText(text, length) {
                let clamp = '...';
                let node = document.createElement('div');
                node.innerHTML = text;
                let content = node.textContent;
                return content.length > length ? content.slice(0, length) + clamp : content;
            },
            OnDragEnter(e) {
                e.preventDefault();
                this.isDragging = true;
                return false;
            },
            OnDragLeave(e) {
                e.preventDefault();
                this.isDragging = false;
            },
            onInputChange(e){
                this.fileProcess(e.target.files);
            },
            onDrop(e) {
                e.preventDefault();
                e.stopPropagation();
                this.isDragging = false;
                this.fileProcess(e.dataTransfer.files);
            },
            fileProcess(files){
                if (!this.multiple && files.length > 1) {
                    console.log("Can not upload multiple files");
                } else {
                    Array.from(files).forEach((file) => this.addFile(file));
                }
            },
            addFile(file) {
                 if (this.isAcceptableFileType(file) && this.isAcceptableFileSize(file)) {
                    if (file.type.match('image.*')) {
                        file.preview_url = URL.createObjectURL(file);
                    } else {
                        // TODO: Need to load correct static preview image
                        // according to the file type.
                        file.preview_url = '#';
                    }
                    file.custom_id = this.files.length;
                    this.files.push(file);
                }
            },
            isAcceptableFileSize(file){
                if (file.size < (this.maxFileSize * 1024)) {
                    return true;
                } else {
                    console.log(file.name, "exceed file size.");
                    return false;
                }
            },
            isAcceptableFileType(file){
                let self = this, found = false;
                self.extensionArray.forEach(type => {
                    if (file.type.match(type)) {
                        found = true;
                        return;
                    }
                });
                if (!found) {
                    console.log(file.name, "is not matching any acceptable file type.");
                }
                return found;
            },
            removeFile(element) {
                let index = this.files.indexOf(element)
                if (index > -1) {
                    this.files.splice(index, 1)
                }
            }
        },
    })
</script>

<style lang="scss" scoped>
    .preview-image{
        background-repeat: no-repeat;
        background-origin: content-box;
        background-position: center;
        background-size: cover;
    }
    .border-1{
        border-width: 1px;
    }
</style>
