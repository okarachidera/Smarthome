import app from './app';
import { env } from './utils/env';

app.listen(env.port, () => {
  console.log(`Backend listening on port ${env.port}`);
});
