document.addEventListener("DOMContentLoaded", function () {
  const components = {
    text: { type: "text", text: "ข้อความตัวอย่าง", size: "md", color: "#000000" },
    button: { type: "button", action: { type: "uri", label: "กดเลย", uri: "https://example.com" } },
    image: { type: "image", url: "https://placekitten.com/240/240", size: "md", aspectMode: "cover" },
  };

  const toolbox = document.getElementById("toolbox");
  const dropzone = document.getElementById("dropzone");
  const jsonOutput = document.getElementById("jsonOutput");

  for (const key in components) {
    const btn = document.createElement("button");
    btn.className = "btn btn-sm btn-outline-secondary m-1";
    btn.innerText = key;
    btn.draggable = true;
    btn.addEventListener("dragstart", e => {
      e.dataTransfer.setData("component", key);
    });
    toolbox.appendChild(btn);
  }

  dropzone.addEventListener("dragover", e => e.preventDefault());
  dropzone.addEventListener("drop", e => {
    e.preventDefault();
    const type = e.dataTransfer.getData("component");
    if (!type) return;
    const item = components[type];
    builderContents.push(item);
    renderBuilder();
  });

  let builderContents = [];

  function renderBuilder() {
    dropzone.innerHTML = "";
    builderContents.forEach((item, index) => {
      const block = document.createElement("div");
      block.className = "builder-block";
      block.innerText = item.type === "text" ? item.text :
                        item.type === "button" ? item.action.label :
                        item.type === "image" ? "[ภาพ]" : "ไม่ทราบ";
      block.title = "Double click เพื่อลบ";
      block.ondblclick = () => {
        builderContents.splice(index, 1);
        renderBuilder();
      };
      dropzone.appendChild(block);
    });

    const flex = {
      type: "bubble",
      body: { type: "box", layout: "vertical", contents: builderContents }
    };
    jsonOutput.value = JSON.stringify(flex, null, 2);
  }
});
