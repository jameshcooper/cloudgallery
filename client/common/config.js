export const APP_URL = () => {
  let url = document.querySelector('meta[name="og:url"]');
  return url.content;
};
export const API_URL = APP_URL() + "/api/v1";
export default { API_URL, APP_URL };
