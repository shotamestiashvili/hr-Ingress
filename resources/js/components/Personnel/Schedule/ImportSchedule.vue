<template>
    <div class="row">
        <div class="form-row">
            <div class="col-md-12">

                <label class="form-control-label" for="input-file-import"
                >Upload Schedule</label
                >

                <select
                    class="form-select"
                    v-model="selectedYear"
                    aria-label=".form-select-sm example"
                >
                    <option selected>Select Year</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                </select>

                <select
                    class="form-select"
                    v-model="selectedMonth"
                    aria-label=".form-select-sm example"
                >
                    <option selected>Select Month</option>
                    <option value="1">Jan</option>
                    <option value="2">Feb</option>
                    <option value="3">Mar</option>
                    <option value="4">Apr</option>
                    <option value="5">May</option>
                    <option value="6">Jun</option>
                    <option value="7">Jul</option>
                    <option value="8">Aug</option>
                    <option value="9">Sep</option>
                    <option value="10">Oct</option>
                    <option value="11">Nov</option>
                    <option value="12">Dec</option>
                </select>

                <input
                    type="file"
                    class="form-control"
                    id="input-file-import"
                    @change="onFileChange"
                />
                <br />
                <hr />

                <button class="btn btn-info" @click="closeModal()"> Upload </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            error: {},
            import_file: "",
            form_submitting: false,
            selectedYear: "2021",
            selectedMonth: "",
        };
    },
    methods: {
        closeModal(){
            this.$emit("exit", true);
        },

        onFileChange(e) {
            this.import_file = e.target.files[0];
            this.proceedAction();
        },

        proceedAction() {
            let formData = new FormData();

            formData.append("import_file", this.import_file);
            formData.append("selectedYear",this.selectedYear);
            formData.append("selectedMonth", this.selectedMonth);
            axios
                .post("api/import/schedule",
                     formData
                )
                .then((response) => {
                        // this.$emit("exit", true);
                        console.log(response.data.data);
                        this.$emit("exit", true);
                })
                .catch((error) => {
                    // code here when an upload is not valid
                    this.uploading = false;
                    this.error = error.response.data;
                    console.log(error.response.data);
                });
        },
    },
};
</script>
