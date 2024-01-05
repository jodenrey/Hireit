<template>
  <div class="login-page--container" :class="{ 'lecturer-bg': lecturerRole }">
    <div v-if="!$matchMedia.xl" class="login-page--logo">
      <router-link :to="{ name: 'index' }">
        <img src="/images/Hireitlogo.png" alt="">
      </router-link>
    </div>
    <div v-else class="desktop-login__left--container">
      <div>
        <img :src="role.img.top" alt="" class="desktop-register__left--img desktop-register__left-top--img">
      </div>
      <div class="flex-row space-between mt-1_5" :class="role.class.midImage">
        <div class="flex-column space-between h100">
          <img :src="role.img.midLeft" alt="" class="desktop-register__left--img desktop-register__left-mid-small--img">
        </div>
        <img :src="role.img.midRight" alt="" class="desktop-register__left--img desktop-register__left-mid-big--img ">
      </div>
      <div>
        <h2 class="desktop-login__left--h2 mt-1_5">
          {{ role.text }}
        </h2>
      </div>
    </div>

    <div class="login-form--container">
      <router-link v-if="$matchMedia.xl" :to="{ name: 'index' }" class="mx-auto mb-2_5">
        <img class="desktop-nav__logo" src="/images/Hireitlogo.png" alt="">
      </router-link>

      <h1 class="login--h1">
        Who are you?
      </h1>
      <div class="login-role--container">
        <div>
          <input id="login-student" v-model="form.role" class="login-radio" type="radio" value="Student">
          <label class="login-radio--label" for="login-student" @click="chooseStudent">Freelancers</label>
        </div>
        <div>
          <input id="login-lecturer" v-model="form.role" class="login-radio" type="radio" value="Lecturer">
          <label class="login-radio--label" for="login-lecturer" @click="chooseLecturer">Clients</label>
        </div>
      </div>

      <div v-if="!$matchMedia.xl" class="role--choose-effect" :class="{ 'role--student': studentRole, 'role--lecturer': lecturerRole }" />
      <div v-else class="separator mt-1_5 mb-2">
        Sign In
      </div>

      <form @submit.prevent="login" @keydown="form.onKeydown($event)">
        <!-- Email -->
        <div class="login-input--container">
          <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="login-input" type="email" name="email" placeholder="Email" autocomplete="username" required>
          <has-error :form="form" field="email" />
        </div>

        <!-- Password -->
        <div class="login-input--container">
          <div class="right-tag__group ">
            <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="right-tag__input login--left-border" :type="passwordType" name="password" placeholder="Password" autocomplete="current-password" required>
            <div v-show="hidePassword" class="pointer right-tag" @click="togglePassword">
              <span class="iconify password__hide-icon" data-icon="carbon:view-off-filled" width="20" height="20" />
            </div>
            <div v-show="!hidePassword" class="pointer right-tag" @click="togglePassword">
              <span class="iconify password__hide-icon " data-icon="carbon:view-filled" width="20" height="20" />
            </div>
          </div>
          <has-error :form="form" field="password" />
        </div>

        <!-- Remember Me -->
        <div class="login-input--container">
          <label class="checkbox-container checkbox-container--post">Remember Me
            <input v-model="remember" name="remember" type="checkbox">
            <span class="checkbox-checkmark checkbox-checkmark-remember" />
          </label>
        </div>

        <div class="">
          <!-- Submit Button -->
          <v-button :loading="form.busy" class="login-submit--button" :class="{ 'is-lecturer': lecturerRole }">
            Sign In
          </v-button>
        </div>
      </form>
      <div class="login-extra">
        <p>
          Don't have an account?
          <router-link :to="{ name: 'register' }" class="login-link">
            <b>Sign Up</b>
          </router-link>
        </p>
        <p>
          <router-link :to="{ name: 'password.request' }" class="login-link">
            <b>Forgot Password?</b>
          </router-link>
        </p>
      </div>
      <div v-if="$matchMedia.xl" class="desktop-login__footer">
         All Rights Reserved. &copy; 2023 . | Created by Students from STI SJDM
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  name: 'LoginPage',
  layout: 'wide',
  middleware: 'guest',

  metaInfo () { return { title: 'Sign In' } },

  data: () => ({
    studentRole: false,
    lecturerRole: false,
    hidePassword: true,
    passwordType: 'password',

    form: new Form({
      role: 'Student',
      email: '',
      password: ''
    }),
    remember: false
  }),

  computed: {
    ...mapGetters({
      snackbar: 'notification/snackbar'
    }),

    role () {
      if (this.form.role === 'Student') {
        return {
          img: {
            top: '/images/login-top-student.png',
            midLeft: '/images/login-mid-left-1-student.png',
            midRight: '/images/login-mid-right-student.png'
          },
          class: {
            midImage: ''
          },
          text: 'Find your clients.'
        }
      }

      return {
        img: {
          top: '/images/login-top-lecturer.png',
          midLeft: '/images/login-mid-left-1-lecturer.png',
          midRight: '/images/login-mid-right-lecturer.png'
        },  
        class: {
          midImage: 'row-reverse'
        },
        text: 'Find a freelancer.'
      }
    }
  },

  methods: {
    async login () {
     /* const isLecturer = this.form.email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@(?!.*(student)).*sjdelmonte.sti.edu.ph*$/)
      const isStudent = this.form.email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@(?!.*(student)).*sjdelmonte.sti.edu.ph*$/)

      if (this.form.role === 'Lecturer' && !isLecturer) {
        this.snackbar.open('You are not likely from STI San Jose Del Monte.')
        this.chooseStudent()
        this.form.role = 'Student'
        return
      } else if (this.form.role === 'Student' && !isS) {
        this.snackbar.open('You are not likely from STI San Jose Del Monte.')
        this.chooseLecturer()
        this.form.role = 'Lecturer'
        return
      } */

      this.form.post('/api/login')
        .then(({ data }) => {
          this.$store.dispatch('auth/saveToken', {
            token: data.token,
            remember: this.remember
          })
          this.$router.back()
        })
        .catch(e => {
          // console.log(e.response.data.message)
        })
    },

    chooseStudent () {
      this.studentRole = true
      this.lecturerRole = false
    },

    chooseLecturer () {
      this.lecturerRole = true
      this.studentRole = false
    },
    togglePassword () {
      this.hidePassword = !this.hidePassword
      this.passwordType = this.hidePassword ? 'password' : 'text'
    }
  }
}
</script>
