<template>
  <div class="row">
    <div class="form-row">
      <div class="col-md-12">
        <label class="form-control-label" for="input-file-import"
          >Upload Excel File</label
        >
        <input
          type="file"
          class="form-control"
          id="input-file-import"
          @change="onFileChange"
        />
        <br />
        <hr />
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
    };
  },
  methods: {
    onFileChange(e) {
      this.import_file = e.target.files[0];
      this.proceedAction();
    },

    proceedAction() {
      let formData = new FormData();

      formData.append("import_file", this.import_file);
      axios
        .post("api/import/position", formData)
        .then((response) => {
          if (response.status === 200) {
            this.$emit("exit", true);
          }
        })
        .catch((error) => {
          // code here when an upload is not valid
          this.uploading = false;
          this.error = error.response.data;
          console.log("check error: ", this.error);
        });
    },
  },
};
</script>
