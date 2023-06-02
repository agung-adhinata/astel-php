document.addEventListener('alpine:init', () => {
  Alpine.data("transaction", () => ({
    reportForm: {
      month: "",
      group: "",
      month: "",
    }
  }))
})