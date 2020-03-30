import { createApp } from './app'

const { app, router } = createApp()

renderVueComponentToString(app, (err, res) => {
  print(res)
})