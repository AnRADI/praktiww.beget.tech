<template>
	<admin-layout>

		<Head>
			<title> Добавить продукт </title>
		</Head>

		<div class="add-product content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0"></h1>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<form @submit.prevent="submitAddProduct" class="content">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="card card-primary">

								<div class="card-body">
									<success-or-failed></success-or-failed>
									<div class="form-group">
										<label for="exampleInputname">Имя</label>
										<input type="text" v-model="form.name" class="form-control" id="exampleInputname" placeholder="Введите имя продукта">
										<div class="errors" v-if="form.errors.name">{{ form.errors.name }}</div>
									</div>
									<div class="form-group">
										<label>Описание</label>
										<textarea v-model="form.description" class="form-control" rows="5" placeholder="Введите описание продукта"></textarea>
									</div>
									<div class="errors" v-if="form.errors.description">{{ form.errors.description }}</div>
									<div class="form-group">
										<label>Категории</label>
										<select multiple="multiple" class="custom-select categories" style="width: 100%;">
<!--												<option disabled value="">Выберите категорию или категории</option>-->
<!--												<option value="8">Ошибочная категория</option>-->
											<option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
										</select>
										<div class="errors" v-if="form.errors.category_ids">{{ form.errors.category_ids }}</div>
									</div>
									<div class="form-group">
										<text-input type="number" v-model="form.price" v-bind="textInput1" :error="form.errors.price" step="0.01" />
									</div>
									<div class="form-group">
										<p class="labels">Метки</p>
										<checkbox-input v-for="(label, index) in labels" :key="label.id"
												  :value="label.name" v-model="form.label_names"
												  :checkbox-input="checkboxInputs[index]"
										/>
										<div class="errors" v-if="form.errors.label_names">{{ form.errors.label_names }}</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Добавить</button>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="card card-primary">
								<div class="card-body">
									<div class="form-group">

										<label>Изображение</label>

										<div v-if="imageState == 'empty'" class="img-fluid image-preview" @click="clickInput">
											<i class="fa fa-plus text-success"></i>
										</div>
										<img v-else-if="imageState == 'ready'" :src="imageSrc" class="img-fluid image-preview" @click="clickInput" alt="">

										<input ref="uploadImage" class="d-none" type="file" name="image" accept="image/*" @change="fileInputChange">

										<div class="errors" v-if="form.errors.image">{{ form.errors.image }}</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!-- /.content -->
		</div>

	</admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import SuccessOrFailed from "@/Components/SuccessOrFailed";
    import CheckboxInput from '@/Components/Checkbox';
    import TextInput from "@/Components/Input";

    export default {


        components: {
            TextInput,
            SuccessOrFailed,
			AdminLayout,
			CheckboxInput
        },

		props: {
            categories: Array,
			labels: Array,
            flash: Object,
		},

		data() {
            return {
				form: this.$inertia.form({
					name: '',
					description: null,
					category_ids: [],
					price: null,
					label_names: [],
					image: {},
				}),
                imageState: 'empty',
                imageSrc: '',
                textInput1: {
                    label: {
                        text: 'Цена'
                    },
					input: {
                        class: 'price'
					}
                },
				checkboxInputs: [
				    ...this.labels.map((v, i) => ({
							label: {
								name: this.labels[i].name,
								nameLocation: 'right',
							}
					}))
                ]
			}
		},

		mounted() {

            this.selectCategories();
        },

		computed: {

            selectClass() {

                return $('.add-product .categories');
			},
		},

		methods: {

            clickInput() {
                this.$refs.uploadImage.click();
            },

            fileInputChange(event) {

                this.form.image = event.target.files[0];
                const reader = new FileReader();

                reader.onload = e => {

                    this.imageState = 'ready';
                    this.imageSrc = e.target.result;
                };

                reader.readAsDataURL(this.form.image);
                event.target.value = '';
            },

            submitAddProduct() {

                this.form.post(route('dashboard.products.store'), {

                    onSuccess: () => {
                        this.form.reset();
                        this.imageState = 'empty';
                        this.selectClass.val(null).trigger('change');
					},
				});
			},

            selectCategories() {

                this.selectClass.select2();

                this.selectClass.on('select2:select', (e) => {

                    this.form.category_ids.push(e.params.data.id);
                });

                this.selectClass.on('select2:unselect', (e) => {

                    let index = this.form.category_ids.indexOf(e.params.data.id);

                    this.form.category_ids.splice(index, 1);
                });
			}
		}

    }
</script>

<style lang="scss">


	.add-product {

		.image-preview {
			display: flex;
			align-items: center;
			justify-content: center;
			border: 1px dashed green;
			cursor: pointer;
			height: 365px;
		}

		img.image-preview {
			border: none;
		}

		.price {
			width: auto;
		}

		.labels {
			font-weight: 700;
			margin-bottom: .5rem;
		}

		.errors {
			margin-top: .25rem;
			font-size: .875em;
			color: #dc3545;
		}

	}

</style>