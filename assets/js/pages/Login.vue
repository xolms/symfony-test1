<template>
  <div class="page page_login">
    <div class="login">
      <div class="login__wrapper">
        <h1 class="login__title">Вход</h1>
        <div class="login__errors" v-if="error">
          <ul>
            <li>{{error}}</li>
          </ul>
        </div>
        <form @submit.prevent="submitForm" class="login__form">
          <div class="login__item">
            <label for="login" class="login__label">Логин/ID</label>
            <div class="login__wrap">
              <input
                  type="text"
                  id="login"
                  placeholder="+7 (000) 000-00-00"
                  class="login__input"
                  v-model="phone"
                  required
                  v-mask="'+7 (###) ###-##-##'"
              >
              <div class="login__icon">
                <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M3.30739 4.78633C3.27897 4.77636 3.25043 4.76635 3.22265 4.7547C2.36102 4.39042 1.75653 3.53715 1.75694 2.54246C1.75694 2.50131 1.75973 2.46096 1.76252 2.42055C1.76319 2.41085 1.76386 2.40115 1.76449 2.39144C1.84286 1.13634 2.88286 0.141846 4.15755 0.141846C5.48367 0.141846 6.55837 1.21695 6.55837 2.54266V2.54593C6.55714 3.2894 6.21673 3.95144 5.6851 4.39103C5.68347 4.39246 5.68209 4.39384 5.68071 4.39521C5.67934 4.39659 5.67796 4.39797 5.67633 4.3994C5.67529 4.40017 5.67424 4.40092 5.67318 4.40168C5.67089 4.40333 5.66856 4.40499 5.66633 4.40695C5.65904 4.41273 5.65148 4.41812 5.64393 4.4235C5.63709 4.42837 5.63027 4.43324 5.62367 4.43838C5.61043 4.44859 5.59743 4.45899 5.58446 4.46936C5.55804 4.49049 5.53173 4.51153 5.50367 4.53083C5.50323 4.53112 5.50279 4.53146 5.50234 4.53182C5.50152 4.53247 5.50064 4.53316 5.49959 4.53368C5.44592 4.57001 5.38959 4.60307 5.33306 4.63491C5.32877 4.6374 5.32458 4.64004 5.32038 4.64269C5.31358 4.64697 5.30678 4.65125 5.29959 4.65491C5.25143 4.68123 5.20041 4.7045 5.1498 4.72715C5.141 4.73111 5.1324 4.73545 5.12376 4.7398C5.11234 4.74555 5.10085 4.75134 5.08878 4.75634C5.0528 4.77159 5.01534 4.78442 4.97793 4.79723C4.96929 4.80019 4.96066 4.80314 4.95204 4.80613C4.94128 4.8099 4.93067 4.81394 4.92005 4.81799C4.90307 4.82446 4.88607 4.83094 4.86837 4.83634C4.83748 4.84588 4.80573 4.85358 4.77406 4.86125C4.76241 4.86408 4.75077 4.8669 4.73918 4.8698C4.72695 4.87286 4.71488 4.87614 4.70282 4.87941C4.68187 4.8851 4.66094 4.89078 4.63918 4.89532C4.60788 4.90169 4.57571 4.90602 4.54362 4.91035C4.53157 4.91197 4.51953 4.91359 4.50755 4.91532C4.49418 4.91724 4.48093 4.91945 4.46771 4.92165C4.4458 4.9253 4.42398 4.92894 4.40184 4.93123C4.32122 4.9394 4.2402 4.94368 4.15776 4.94368H4.15735H4.15571H4.15531C3.90653 4.94327 3.66714 4.90552 3.44184 4.83491C3.41938 4.82799 3.39759 4.81965 3.37573 4.81128C3.36341 4.80656 3.35107 4.80184 3.33857 4.79736C3.32822 4.79363 3.31781 4.78998 3.30739 4.78633ZM8.12237 9.73372C8.12445 9.70137 8.12653 9.66898 8.12653 9.63613C8.12653 8.02817 7.17041 6.64613 5.79694 6.02042C5.79653 6.02001 5.79571 6.0196 5.79531 6.0196C5.73347 5.99123 5.67143 5.96491 5.60837 5.93981C5.54286 5.91409 5.47633 5.8896 5.40939 5.86736C5.35592 5.8494 5.30225 5.83307 5.24796 5.81756C5.16531 5.79368 5.08204 5.77185 4.99714 5.75307C4.96082 5.74532 4.92429 5.73858 4.88714 5.73185C4.83143 5.72103 4.7751 5.71144 4.71816 5.70307H4.71694C4.70757 5.70173 4.69819 5.70036 4.6888 5.69899C4.65115 5.69349 4.61333 5.68797 4.5751 5.68389C4.56907 5.68338 4.56304 5.68291 4.55699 5.68243C4.54584 5.68155 4.53464 5.68066 4.52327 5.6796C4.50204 5.67776 4.48102 5.67613 4.4598 5.6745C4.44917 5.67378 4.43902 5.67274 4.4285 5.67166L4.42429 5.67123C4.33429 5.66511 4.24367 5.66083 4.15204 5.66083C4.05531 5.66083 3.95918 5.66613 3.86388 5.67287C3.84714 5.67389 3.83 5.67552 3.81327 5.67715C3.80449 5.67797 3.79571 5.67878 3.78694 5.67919C3.77994 5.67981 3.77292 5.68036 3.76589 5.68091C3.75201 5.68199 3.7381 5.68308 3.72429 5.6847C3.66163 5.69144 3.6 5.70062 3.53816 5.71021H3.53776C3.49796 5.71674 3.45878 5.72389 3.4198 5.73144C3.37796 5.73899 3.33612 5.74736 3.29429 5.75654C3.21327 5.7745 3.13327 5.79532 3.05388 5.81838C2.99225 5.83593 2.93122 5.85532 2.8702 5.87654C2.86276 5.87886 2.85554 5.88154 2.84827 5.88424C2.84338 5.88605 2.83848 5.88788 2.83347 5.8896C2.71 5.93348 2.58918 5.98246 2.47163 6.03756C2.47143 6.03776 2.47122 6.03787 2.47102 6.03797C2.47082 6.03807 2.47061 6.03817 2.47041 6.03838C1.11714 6.67225 0.177551 8.04246 0.177551 9.63613C0.177551 9.66923 0.179757 9.70193 0.181967 9.73468C0.183313 9.75464 0.18466 9.77461 0.18551 9.7947H8.11898C8.11977 9.77432 8.12107 9.75402 8.12237 9.73372Z" fill="#141213"/>
                </svg>
              </div>
            </div>
          </div>
          <div class="login__item">
            <label for="password" class="login__label">Пароль</label>
            <div class="login__wrap">
              <input
                  :type="showPassword ? 'text' : 'password'"
                  id="password"
                  placeholder="*******"
                  class="login__input"
                  required
                  v-model="password"
              >
              <div class="login__icon login__icon_password" @click="showPassword = !showPassword">
                <svg style="width:10px;height:10px" viewBox="0 0 24 24" v-if="!showPassword">
                  <path fill="currentColor" d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" />
                </svg>
                <svg style="width:10px;height:10px" viewBox="0 0 24 24" v-else>
                  <path fill="currentColor" d="M2,5.27L3.28,4L20,20.72L18.73,22L15.65,18.92C14.5,19.3 13.28,19.5 12,19.5C7,19.5 2.73,16.39 1,12C1.69,10.24 2.79,8.69 4.19,7.46L2,5.27M12,9A3,3 0 0,1 15,12C15,12.35 14.94,12.69 14.83,13L11,9.17C11.31,9.06 11.65,9 12,9M12,4.5C17,4.5 21.27,7.61 23,12C22.18,14.08 20.79,15.88 19,17.19L17.58,15.76C18.94,14.82 20.06,13.54 20.82,12C19.17,8.64 15.76,6.5 12,6.5C10.91,6.5 9.84,6.68 8.84,7L7.3,5.47C8.74,4.85 10.33,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C12.69,17.5 13.37,17.43 14,17.29L11.72,15C10.29,14.85 9.15,13.71 9,12.28L5.6,8.87C4.61,9.72 3.78,10.78 3.18,12Z" />
                </svg>
              </div>
            </div>
          </div>
          <div class="login__button">
            <button class="button button_grey button_radius button_shadow button_login">Войти</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      phone: '',
      password: '',
      error: '',
      showPassword: false
    }
  },
  methods: {
    async submitForm() {
      try {
        const resp = await this.$axios.post('/api/login_check', {
          username: this.phone,
          password: this.password
        })
        if (resp && resp.status === 200) {
          this.error = null
          const token = `Bearer ${resp.data.token}`
          localStorage.setItem('token', token)
          this.$store.commit('changeUser', token)
          this.$axios.defaults.headers.common['Authorization'] = token
          return this.$router.replace('/')
        }
        else {
          return this.error = resp.data.message
        }
      }
      catch (e) {
        console.log(e)
      }
    }
  },
}
</script>

<style scoped lang="scss">
.page {
  &_login {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
}

.login {
  background: #EEEEEE;
  box-shadow: 0px 2px 7px 1px rgba(88, 88, 88, 0.4);
  min-height: 320px;
  max-width: 350px;
  width: 100%;
  padding: 35px 35px 28px;

  &__title {
    margin: 0;
    padding: 0;
    font-size: 24px;
    font-weight: normal;
  }

  &__item {
    padding-top: 25px;
  }
  &__wrap {
    position: relative;
  }
  &__label {
    font-size: 9px;
    opacity: .4;
    text-transform: uppercase;
    color: #141213;
  }
  &__input {
    width: 100%;
    outline: none;
    border: none;
    padding: 9px 0;
    font-size: 12px;
    color: #141213;
    background: transparent;
    border-bottom: 1px solid rgba(#141213, .1);
  }
  &__icon {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0.4;
    &_password {
      cursor: pointer;
    }
  }
  &__errors {
    max-width: 280px;
    min-height: 40px;
    background: #FFECEC;
    border: 0.5px solid #FF0000;
    border-radius: 8px;
    margin-top: 18px;
    ul {
      list-style-type: none;
      padding: 12px 8px;
      margin: 0;
    }
    li {
      line-height: 20px;
      font-size: 12px;
      color: #D81919;
      font-weight: 300;
    }
  }
  &__button {
    padding-top: 40px;
  }
}
</style>