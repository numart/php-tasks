( function () {

  const taskComplete = {
    init: function () {
      const checkboxes = document.querySelectorAll('.task-complete')

      checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', this.setComplete)
      })

    },
    setComplete: function (e) {
      const checkbox = e.target
      console.log('ID:', checkbox.dataset.id)
      console.log('Marcado:', checkbox.checked)

      fetch('/complete-task', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          id: this.dataset.id,
          completed: this.checked,
        }),
      })
    },
  }

  document.addEventListener('DOMContentLoaded', function (e) {
    taskComplete.init()
  })

} )()