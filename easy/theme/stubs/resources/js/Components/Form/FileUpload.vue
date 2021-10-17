<template>
    <draggable
        class="flex flex-wrap"
        tag="div"
        :list="fileList"
        :group="{ name: 'g11' }"
        item-key="initial_sort_index">
        <template #item="{ element }">
            <div v-show="element.show" class="flex-none w-1/4 mb-4">
                <div class="border-2 p-2 mx-2 border-gray-300 rounded-md shadow-sm">
                    <div class="w-full h-32 preview-image" :style="{ backgroundImage: 'url(' + element.url + ')'}" />
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
                    class="hidden"
                    @input="onSelect"
                    :id="id"
                    :accept="accept"
                    :multiple="multiple"
                    ref="fileInput">
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
            },
            modelValue: {
                required: true,
            },
        },
        emits: ['update:modelValue'],
        data: () => ({
            fileList: [],
            isDragging: false,
            extensionArray: [],
        }),
        computed:{
            canShow() {
                if (this.fileList.length === 0) {
                    return true;
                } else if (this.fileList.length > 0 && !this.multiple ) {
                    let visible = 0
                    this.fileList.forEach(element => {
                        if (element.show) {
                            visible ++
                        }
                    });
                    if (visible === 0) {
                        return true;
                    }
                } else if (this.fileList.length > 0 && this.multiple ) {
                    return true;
                }
                return false;
            }
        },
        watch: {
            modelValue: {
                handler(val) {
                    if (Array.isArray(val) && !val.length) {
                        this.cretePreviewArray();
                        this.fileList = [];
                    }
                },
                deep: true
            },
        },
        created () {
            this.extensionArray = this.accept.replace(/\s/g,'').split(',');
            this.cretePreviewArray();
        },
        methods: {
            cretePreviewArray() {
                let tempArray = [];
                if (Array.isArray(this.modelValue) && this.modelValue.length) {
                    this.modelValue.forEach(element => {
                        if (element.id) {
                            element.initial_sort_index = tempArray.length
                            element.show = true
                            element.file = null
                            tempArray.push(element);
                        }
                    });
                }
                this.fileList = tempArray;
            },
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
            onDrop(e) {
                e.preventDefault();
                e.stopPropagation();
                this.isDragging = false;
                this.fileProcess(e.dataTransfer.files);
            },
            onSelect(e){
                this.fileProcess(e.target.files);
            },
            fileProcess(files){
                if (!this.multiple && files.length > 1) {
                    console.log("Can not upload multiple files");
                } else {
                    Array.from(files).forEach((file) => {
                        if (this.isAcceptableFileType(file) && this.isAcceptableFileSize(file)) {
                            //TODO: preview image other than image type
                            this.fileList.push({
                                id : null,
                                initial_sort_index : this.fileList.length,
                                url : (file.type.match('image.*')) ? URL.createObjectURL(file) : '#',
                                name: file.name,
                                size: file.size,
                                file: file,
                                show: true
                            })
                        }
                    });
                    if (this.fileList.length > 0) {
                        this.$emit('update:modelValue', this.fileList)
                    }
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
                let index = this.fileList.indexOf(element)
                if (index > -1) {
                    if (element.file) {
                        this.fileList.splice(index, 1)
                    } else {
                        this.fileList[index].show = false
                    }
                }
            }
        }
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
