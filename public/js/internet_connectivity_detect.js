// const checkOnlineStatus = async () => {
//   try {
//     const online = await fetch("https://introjs.com/");
//     return online.status >= 200 && online.status < 300; // either true or false
//   } catch (err) {
//     return false; // definitely offline
//   }
// };

// var internet_failed = false;
// setInterval(async () => {
//   const result = await checkOnlineStatus();
//   if (!result && !internet_failed) {
//     internet_failed = true;
//     swal({
//       title: 'Internet Connection Failed',
//       text: 'Please check your internet connection.',
//       type: 'error',
//       showConfirmButton: false,
//       allowOutsideClick: false,
//     })
//   } else if (result && internet_failed) {
//       internet_failed = false;
//       let timerInterval;
//       Swal.fire({
//         title: 'Internet Connection Established',
//         html: 'you can continue your work after <b></b>',
//         timer: 3000,
//         timerProgressBar: true,
//         willOpen: () => {
//           Swal.showLoading()
//           timerInterval = setInterval(() => {
//             const content = Swal.getContent()
//             if (content) {
//               const b = content.querySelector('b')
//               if (b) {
//                 b.textContent = Swal.getTimerLeft()
//               }
//             }
//           }, 100)
//         },
//         onClose: () => {
//           clearInterval(timerInterval)
//         }
//       }).then((result) => {
//         /* Read more about handling dismissals below */
//         if (result.dismiss === Swal.DismissReason.timer) {
//           console.log('I was closed by the timer')
//         }
//       });
//   }
// }, 3000); 