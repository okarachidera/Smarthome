import { SecurityDecision, SecurityDecisionInput } from '../types';

const dictionaryPhrases = [
  'admin',
  'password',
  'qwerty',
  'letmein',
  'welcome',
  '123456',
  '12345678',
  'root',
  'user',
  'guest'
];

function findMatchedPhrase(value: string): string | undefined {
  const normalized = value.toLowerCase();
  return dictionaryPhrases.find((phrase) => normalized.includes(phrase));
}

// Explicit decision-tree flow to mirror the paper's security diagram.
export function evaluateSecurityDecision(input: SecurityDecisionInput): SecurityDecision {
  const dictionaryPhrase = findMatchedPhrase(input.passwordOrOtp) || findMatchedPhrase(input.username);

  if (input.attemptCount >= input.maxAttempts) {
    if (dictionaryPhrase || input.weakPhraseHits >= 2 || input.repeatedPattern) {
      return {
        action: 'BLOCK_NOTIFY',
        reason: 'Repeated dictionary attack pattern over threshold',
        dictionaryPhrase
      };
    }

    return {
      action: 'NOTIFY',
      reason: `High ${input.phase} attempt volume detected`,
      dictionaryPhrase
    };
  }

  if (dictionaryPhrase) {
    return {
      action: 'NOTIFY',
      reason: `${input.phase} input matched dictionary phrase`,
      dictionaryPhrase
    };
  }

  if (input.repeatedPattern && input.attemptCount >= 2) {
    return {
      action: 'NOTIFY',
      reason: `Repeated ${input.phase} pattern indicates probable brute force`
    };
  }

  return {
    action: 'ALLOW',
    reason: 'No dictionary attack signal observed'
  };
}
