function Main(){
  CreateFile();

  // attend un temps
  WScript.Sleep(1000);

  // affiche un message
  WScript.Echo("un message");

  // affiche une propriéter de la class static WScript
  WScript.Echo(WScript.Path);

  ManipFiles();
  CreatePopup();
  DeleteFiles();
}

function CreateFile(){
  var fso, tf;
  fso = new ActiveXObject("Scripting.FileSystemObject");

  // créer un nouveau fichier
  tf = fso.CreateTextFile("testFile.txt", true);
  // écrit dans le fichier
  tf.WriteLine("Testing 1, 2, 3.") ;
  tf.WriteBlankLines(3) ;
  tf.Write ("This is a test.");
  tf.Close();
}

function CreatePopup() {
  var timeout = 6; // timeout
  var buttons = 3;  // OK
  var icon = 16; // Exclamation

  var shell = new ActiveXObject("WScript.Shell");
  shell.Popup("text ...", timeout, "window title", buttons + icon);
}

function ManipFiles(){
  var fso, f1, f2, f3;
  fso = new ActiveXObject("Scripting.FileSystemObject");

  // crée un fichier et écrit du text
  f1 = fso.CreateTextFile("testFile2.txt", true);
  f1.Write("This is a test.");
  f1.Close();

  // récupére un fichier
  f2 = fso.GetFile("testFile2.txt");

  WScript.Sleep(4000);
  // déplacée/renomer
  f2.Move("testFile3.txt");

  WScript.Sleep(4000);
  // copy le fichier
  f2.Copy("testFile4.txt");
}

function DeleteFiles() {
  var fso, f1, f2, f3;
  fso = new ActiveXObject("Scripting.FileSystemObject");

  // supprime les fichier
  f1 = fso.GetFile("testFile.txt");
  f2 = fso.GetFile("testFile3.txt");
  f3 = fso.GetFile("testFile4.txt");
  f1.Delete();
  f2.Delete();
  f3.Delete();
}

Main();

// Button Types
//
// Value Description
// 0   OK button.
// 1   OK and Cancel buttons.
// 2   Abort, Retry, and Ignore buttons.
// 3   Yes, No, and Cancel buttons.
// 4   Yes and No buttons.
// 5   Retry and Cancel buttons.
//
// Icon Types
//
// Value Description
// 16  "Stop Mark" icon.
// 32  "Question Mark" icon.
// 48  "Exclamation Mark" icon.
// 64  "Information Mark" icon.
//
// Possible values for IntButton the return value:
//
// Value Description
// 1  OK button
// 2  Cancel button
// 3  Abort button
// 4  Retry button
// 5  Ignore button
// 6  Yes button
// 7  No button
