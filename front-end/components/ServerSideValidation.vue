<template>
  <div>
    <b-modal id="server" title="Server Side Validation" hide-footer size="lg">
      <b-card bg-variant="light">
        <b-form novalidate @submit.prevent="submitForm">
          <b-row>
            <b-col cols="4">
              <b-card class="mt-3" header="Form request:">
                <pre class="m-0">{{ form }}</pre>
              </b-card>
            </b-col>

            <b-col cols="8">
              <b-form-group
                label="Supplier:"
                label-for="0"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select
                  id="0"
                  v-model="form.supplier_id"
                  :options="suppliers"
                  :state="errors.supplier_id === null"
                  text-field="name"
                  value-field="id"
                ></b-form-select>
                <b-form-invalid-feedback v-if="errors.supplier_id">
                  {{ errors.supplier_id[0] }}
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Species:"
                label-for="1"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="1"
                  v-model="form.species"
                  :state="errors.species === null"
                  debounce="600"
                ></b-form-input>
                <!-- This will only be shown if the preceding input has an invalid state -->
                <b-form-invalid-feedback v-if="errors.species">
                  {{ errors.species[0] }}
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Grading system:"
                label-for="2"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="2"
                  v-model="form.grading_system"
                  :state="errors.grading_system === null"
                  debounce="600"
                ></b-form-input>
                <b-form-invalid-feedback v-if="errors.grading_system">
                  {{ errors.grading_system[0] }}
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Drying method:"
                label-for="3"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="3"
                  v-model="form.drying_method"
                  :state="errors.drying_method === null"
                  debounce="600"
                ></b-form-input>
                <b-form-invalid-feedback v-if="errors.drying_method">
                  {{ errors.drying_method[0] }}
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Treatment:"
                label-for="4"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="4"
                  v-model="form.treatment"
                  :state="errors.treatment === null"
                  debounce="600"
                ></b-form-input>
                <b-form-invalid-feedback v-if="errors.treatment">
                  {{ errors.treatment[0] }}
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Thickness:"
                label-for="5"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="5"
                  v-model="form.thickness"
                  type="number"
                  no-wheel
                  :state="errors.thickness === null"
                  debounce="600"
                ></b-form-input>
                <b-form-invalid-feedback v-if="errors.thickness">
                  {{ errors.thickness[0] }}
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Width:"
                label-for="6"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="6"
                  v-model="form.width"
                  type="number"
                  no-wheel
                  :state="errors.width === null"
                  debounce="600"
                ></b-form-input>
                <b-form-invalid-feedback v-if="errors.width">
                  {{ errors.width[0] }}
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Length:"
                label-for="7"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="7"
                  v-model="form.length"
                  type="number"
                  no-wheel
                  :state="errors.length === null"
                  debounce="600"
                ></b-form-input>
                <b-form-invalid-feedback v-if="errors.length">
                  {{ errors.length[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </b-col>
          </b-row>
          <b-button-group class="d-flex justify-content-around">
            <b-button variant="success" class="mt-2" type="submit"
              >Save</b-button
            >
          </b-button-group>
        </b-form>
      </b-card>
    </b-modal>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'ServerSideValidation',
  data() {
    return {
      isSpeciesValid: null,
      isGradingValid: null,
      isDryingValid: null,
      isTreatmentValid: null,
      isThicknessValid: null,
      isWidthValid: null,
      isLengthValid: null,

      errors: {
        species: null,
        grading_system: null,
        drying_method: null,
        treatment: null,
        thickness: null,
        width: null,
        length: null,
        supplier_id: null,
      },
      form: {
        supplier_id: null,
        species: null,
        grading_system: null,
        drying_method: null,
        treatment: null,
        thickness: null,
        width: null,
        length: null,
      },
    }
  },
  computed: {
    ...mapState(['suppliers']),
  },
  methods: {
    async submitForm() {
      try {
        const response = await this.$axios.post('/api/products', this.form)
        if (response.status === 200) {
          this.$store.commit('newNotification', {
            title: 'Success!',
            body: response.data.message,
            variant: 'success',
          })
          this.resetForm()
          this.$bvModal.hide('server')
          this.$store.commit('addProduct', {
            data: response.data.data,
          })
        }
      } catch (e) {
        this.errors = e.response.data.errors
        Object.values(e.response.data.errors).forEach((er) =>
          setTimeout(() => {
            this.$store.commit('newNotification', {
              title: 'Invalid!',
              body: er[0],
              variant: 'danger',
            })
          }, 200)
        )
      }
    },
    resetForm() {
      Object.keys(this.form).forEach((key) => (this.form[key] = null))
    },
  },
}
</script>

<style scoped></style>
