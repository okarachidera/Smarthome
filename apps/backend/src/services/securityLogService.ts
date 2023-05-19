import fs from 'fs';
import path from 'path';

export interface SecurityEventLog {
  timestamp: string;
  username: string;
  ipAddress: string;
  phase: 'username' | 'otp';
  action: 'ALLOW' | 'NOTIFY' | 'BLOCK_NOTIFY';
  reason: string;
  dictionaryPhrase?: string;
}

function resolveProjectRoot(startDir: string): string {
  let current = startDir;

  while (true) {
    if (fs.existsSync(path.join(current, 'package.json'))) {
      return current;
    }

    const parent = path.dirname(current);
    if (parent === current) {
      return process.cwd();
    }

    current = parent;
  }
}

const projectRoot = resolveProjectRoot(__dirname);
const dataDir = path.join(projectRoot, 'data');
const filePath = path.join(dataDir, 'security-events.jsonl');

export function appendSecurityEvent(event: SecurityEventLog): void {
  fs.mkdirSync(dataDir, { recursive: true });
  fs.appendFileSync(filePath, `${JSON.stringify(event)}\n`, 'utf-8');
}
