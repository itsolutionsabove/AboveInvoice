import { auth, googleProvider, facebookProvider, appleProvider } from './firebase';

export default {
  methods: {
    signInWithGoogle() {
      auth.signInWithPopup(googleProvider)
        .then((result) => {
          // Send token to the Laravel back-end for verification
          const idToken = result.user.getIdToken();
          this.verifyTokenWithLaravel(idToken);
        })
        .catch((error) => {
          console.error("Google sign-in error:", error);
        });
    },
    signInWithFacebook() {
      auth.signInWithPopup(facebookProvider)
        .then((result) => {
          const idToken = result.user.getIdToken();
          this.verifyTokenWithLaravel(idToken);
        })
        .catch((error) => {
          console.error("Facebook sign-in error:", error);
        });
    },
    signInWithApple() {
      auth.signInWithPopup(appleProvider)
        .then((result) => {
          const idToken = result.user.getIdToken();
          this.verifyTokenWithLaravel(idToken);
        })
        .catch((error) => {
          console.error("Apple sign-in error:", error);
        });
    },
    verifyTokenWithLaravel(idToken) {
      // Send token to the Laravel API
      this.$axios.post('/api/verify-token', { token: idToken })
        .then(response => {
          console.log('Token verified:', response.data);
        })
        .catch(error => {
          console.error('Error verifying token:', error);
        });
    }
  }
};